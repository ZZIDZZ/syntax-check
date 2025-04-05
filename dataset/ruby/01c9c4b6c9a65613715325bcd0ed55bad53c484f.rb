def unlock(token = @tokens.pop)
      return unless token

      removed = false

      @redis.with do |conn|
        removed = conn.zrem grabbed_key, token
        if removed
          conn.lpush available_key, 1
        end
      end

      removed
    end