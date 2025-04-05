def post(query_params)
      servers ||= SERVERS.map{|hostname| "https://#{hostname}/minfraud/chargeback"}
      url = URI.parse(servers.shift)

      req = Net::HTTP::Post.new(url.path, initheader = {'Content-Type' =>'application/json'})
      req.basic_auth Maxmind::user_id, Maxmind::license_key
      req.body = query_params

      h = Net::HTTP.new(url.host, url.port)
      h.use_ssl = true
      h.verify_mode = OpenSSL::SSL::VERIFY_NONE

      # set some timeouts
      h.open_timeout  = 60 # this blocks forever by default, lets be a bit less crazy.
      h.read_timeout  = self.class.timeout || DefaultTimeout
      h.ssl_timeout   = self.class.timeout || DefaultTimeout

      h.start { |http| http.request(req) }

    rescue Exception => e
      retry if servers.size > 0
      raise e
    end