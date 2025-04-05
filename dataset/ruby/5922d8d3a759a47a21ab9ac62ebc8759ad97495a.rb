def api_call method, payload
      raise ArgumentError, "API method not specified." if method.blank?

      payload ||= {}

      res = @conn.post method.to_s, payload

      raise Faraday::Error, "Wrong response: #{res.inspect}" if (res.status != 200)

      return res
    end