def built_in_object_ids
      @built_in_object_ids ||= Hash.new do |hash, key|
        hash[key] = where(built_in_key: key).pluck(:id).first
      end
    end