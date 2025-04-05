def handle_requests
      until @requestmq.empty?
        request = @requestmq.deq(true)
        begin
          request.response = @app.call(request.env)
        rescue Exception => e
          request.exception = e
        ensure
          body = request.response.try(:last)
          body.close  if body.respond_to? :close
        end
      end
    end