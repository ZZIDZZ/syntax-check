def update_by_expire_time(options = {})
      @expired_in = options[:expired_in] if options[:expired_in].present?
      time = Time.now.to_i / expired_in.to_i
      options.merge(expired_in: time)
    end