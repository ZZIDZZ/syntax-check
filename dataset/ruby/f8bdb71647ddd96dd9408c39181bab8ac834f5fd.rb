def post hash={}, payload
      raise 'Payload cannot be blank' if payload.nil? || payload.empty?

      hash.symbolize_keys!
      call(:post, hash[:endpoint], (hash[:args]||{}).merge({:method => :post}), payload)
    end