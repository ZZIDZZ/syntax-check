def perform_request(http_method, path, klass, key, options = {})
      if @consumer_key.nil? || @consumer_secret.nil?
        raise WithingsSDK::Error::ClientConfigurationError, "Missing consumer_key or consumer_secret"
      end
      options = WithingsSDK::Utils.normalize_date_params(options)
      request = WithingsSDK::HTTP::Request.new(@access_token, { 'User-Agent' => user_agent })
      response = request.send(http_method, path, options)
      if key.nil?
        klass.new(response)
      elsif response.has_key? key
        response[key].collect do |element|
          klass.new(element)
        end
      else
        [klass.new(response)]
      end
    end