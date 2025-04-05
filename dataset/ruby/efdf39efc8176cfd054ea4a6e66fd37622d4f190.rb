def native_representation_of(response_body)
      # Do we have a collection of objects?
      if response_body.is_a? Array
        WpApiClient::Collection.new(response_body, @headers)
      else
        WpApiClient::Entities::Base.build(response_body)
      end
    end