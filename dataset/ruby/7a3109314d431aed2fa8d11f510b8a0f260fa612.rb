def filter(params)
      results = where(nil)
      params.each do |key, value|
        results = results.public_send(key, value) if value.present?
      end
      results
    end