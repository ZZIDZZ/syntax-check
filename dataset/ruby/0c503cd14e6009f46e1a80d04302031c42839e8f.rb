def run
      client_ip = @ip
      key = "request_count:#{client_ip}"
      result = { status: Constants::SUCCESS_STATUS, message: Constants::OK_MESSAGE }
      requests_count = @storage.get(key)
      unless requests_count
        @storage.set(key, 0)
        @storage.expire(key, @limits["time_period_seconds"])
      end
      if requests_count.to_i >= @limits["max_requests_count"]
        result[:status] = Constants::EXPIRED_STATUS
        result[:message] = message(period(key))
      else
        @storage.incr(key)
      end
      result
    end