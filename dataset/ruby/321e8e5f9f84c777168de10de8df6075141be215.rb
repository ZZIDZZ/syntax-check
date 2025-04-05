def with(temp_current)
      keys = temp_current.keys.map{|k| to_character(k)}
      previous_values = current.values_at(*keys)
      current.merge!(Hash[keys.zip(temp_current.values)])
      yield
    ensure
      current.merge!(Hash[keys.zip(previous_values)])
    end