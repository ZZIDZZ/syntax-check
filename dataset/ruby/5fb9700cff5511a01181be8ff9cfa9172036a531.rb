def check_retry
      if @finished_publishing && @pending_hash.empty? && @exception_count > 0 && (@retry || @auto_retry)
        # If we're just doing auto_retry but nothing succeeded last time, then don't run again
        return if !@retry && @auto_retry && @exception_count == @exceptions_per_run.last
        Qwirk.logger.info "#{self}: Retrying exception records, exception count = #{@exception_count}"
        @exceptions_per_run << @exception_count
        @exception_count = 0
        @finished_publishing = false
        @fail_thread = Thread.new(@exceptions_per_run.last) do |count|
          begin
            java.lang.Thread.current_thread.name = "Qwirk fail task: #{task_id}"
            while !@stopped && (count > 0) && (object = @fail_consumer.receive)
              count -= 1
              publish(object)
              @fail_consumer.acknowledge_message
            end
            @finished_publishing = true
            @pending_hash_mutex.synchronize { check_finish }
          rescue Exception => e
            do_stop
            Qwirk.logger.error "#{self}: Exception, thread terminating: #{e.message}\n\t#{e.backtrace.join("\n\t")}"
          end
        end
      end
    end