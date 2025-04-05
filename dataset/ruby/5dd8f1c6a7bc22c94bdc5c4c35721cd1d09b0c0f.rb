def send_request(text)
      begin
        request = Net::HTTP::Post.new(@url.path, {
          'Content-Type' => 'text/xml',
          'SOAPAction' => '"http://typograf.artlebedev.ru/webservices/ProcessText"'
        })
        request.body = form_xml(text, @options)

        response = Net::HTTP.new(@url.host, @url.port).start do |http|
          http.request(request)
        end
      rescue StandardError => exception
        raise NetworkError.new(exception.message, exception.backtrace)
      end

      if !response.is_a?(Net::HTTPOK)
        raise NetworkError, "#{response.code}: #{response.message}"
      end

      if RESULT =~ response.body
        body = $1.gsub(/&gt;/, '>').gsub(/&lt;/, '<').gsub(/&amp;/, '&')
        body.force_encoding("UTF-8").chomp
      else
        raise NetworkError, "Can't match result #{response.body}"
      end
    end