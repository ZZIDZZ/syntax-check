def get(url)
      uri      = URI.parse("#{BASE_URL}#{url}/")
      https    = Net::HTTP.new(uri.host, uri.port)
      https.read_timeout = @options[:timeout] if @options[:timeout]
      https.verify_mode = OpenSSL::SSL::VERIFY_NONE
      https.use_ssl = true
      request  = Net::HTTP::Get.new(uri.request_uri, @headers)
      response = https.request(request)

      # Response code error checking
      if response.code != '200'
        check_response(response.code, response.body)
      else
        parse_json(response.body)
      end
    end