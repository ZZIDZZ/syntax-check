def run_request(request, format)
      # Is this a v3 request?
      v3_request = request.url.include?("/#{v3_hostname}/")
      # Execute with retries
      retries = [1] * @retries
      begin 
        begin
          d "Queuing the request for #{request.url}"
          add_authentication_to(request) if @auth_token && !v3_request
          hydra.queue request
          hydra.run
          # Return response if OK
        end while !response_ok?(request.response, request)
        # Store updated authToken
        @auth_token = request.response.headers_hash['AuthToken']
        return request.response
      rescue AMEE::ConnectionFailed, AMEE::TimeOut => e
        if delay = retries.shift
          sleep delay
          retry
        else
          raise
        end
      end
    end