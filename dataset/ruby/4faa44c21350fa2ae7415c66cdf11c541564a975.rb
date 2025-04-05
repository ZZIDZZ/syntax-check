def drain_queue(queue)
      result = []

      queue_size = queue.size
      begin
        queue_size.times do
          result << queue.deq(:raise_if_empty)
        end
      rescue ThreadError
        # Need do nothing, queue was concurrently popped, no biggie
      end

      return result
    end