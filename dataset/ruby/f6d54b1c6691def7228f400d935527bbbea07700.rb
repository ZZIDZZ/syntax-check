def get(options={})
    uri = new_uri
    params = merge_params(options)
    uri.query = URI.encode_www_form(params)

    Net::HTTP.start(uri.host, uri.port, :use_ssl => uri.scheme == 'https') do |http|
      request = Net::HTTP::Get.new(uri)
      response = http.request(request)
      unless response.is_a?(Net::HTTPSuccess)
        raise "#{response.code} #{response.message}\n#{response.body}"
      end
      return response.body
    end
  end