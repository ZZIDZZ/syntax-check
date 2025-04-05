def time_remaining(timeout)
      return unless timeout
      raise Socketry::InternalError, "no deadline set" unless @deadline

      remaining = @deadline - lifetime
      raise Socketry::TimeoutError, "time expired" if remaining <= 0

      remaining
    end