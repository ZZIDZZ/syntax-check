def authenticate!
      options = authentication_handler.call(self, @options)
      @options.merge!(options)
      client.config.soap_header = soap_headers
    end