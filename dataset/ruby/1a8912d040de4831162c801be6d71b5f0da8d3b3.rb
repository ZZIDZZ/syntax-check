def create_event(type:, data:)
      raise ArgumentError.new("type must be provided") if type.nil?

      raise ArgumentError.new("data must be provided") if data.nil?

      headers = {
      }
      sdk_headers = Common.new.get_sdk_headers("discovery", "V1", "create_event")
      headers.merge!(sdk_headers)

      params = {
        "version" => @version
      }

      data = {
        "type" => type,
        "data" => data
      }

      method_url = "/v1/events"

      response = request(
        method: "POST",
        url: method_url,
        headers: headers,
        params: params,
        json: data,
        accept_json: true
      )
      response
    end