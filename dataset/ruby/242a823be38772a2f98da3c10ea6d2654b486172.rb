def tagify input
      output = input.dup
      raise StandardError, "@tags is empty!" if @tags.empty? #improve on this
      @tags.each {|key,value| output.gsub!(tag_start.to_s+key.to_s+tag_end.to_s, value.to_s)}
      return output
    end