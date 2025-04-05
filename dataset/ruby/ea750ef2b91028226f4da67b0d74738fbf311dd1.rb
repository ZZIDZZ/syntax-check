def part(name)
      parts.select {|p| p.name.downcase == name.to_s.downcase }.first
    end