def destroy_aliases!
      #do it only if it is existing object!
      if redis_old_keys[:aliases].size > 0
        redis_old_keys[:aliases].each do |alias_key|
          RedisModelExtension::Database.redis.srem alias_key, redis_old_keys[:key]
          #delete alias with 0 keys
          RedisModelExtension::Database.redis.del(alias_key) if RedisModelExtension::Database.redis.scard(alias_key).to_i == 0
        end
      end
    end