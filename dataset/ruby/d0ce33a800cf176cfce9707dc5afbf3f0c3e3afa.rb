def string(opts = {})
      length, any, value = (opts[:length] || 8), opts[:any], opts[:value]
      if value
        string = value.to_s
        Proc.new { string }
      elsif any
        Proc.new { self.any(any) }
      else
        Proc.new { Array.new(length){@chars[rand(@chars.size-1)]}.join }
      end
    end