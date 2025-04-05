def irregular(singular, plural)
      @uncountables.delete(singular)
      @uncountables.delete(plural)
      if singular[0,1].upcase == plural[0,1].upcase
        plural(Regexp.new("(#{singular[0,1]})#{singular[1..-1]}$", "i"), '\1' + plural[1..-1])
        singular(Regexp.new("(#{plural[0,1]})#{plural[1..-1]}$", "i"), '\1' + singular[1..-1])
      else
        plural(Regexp.new("#{singular[0,1].upcase}(?i)#{singular[1..-1]}$"), plural[0,1].upcase + plural[1..-1])
        plural(Regexp.new("#{singular[0,1].downcase}(?i)#{singular[1..-1]}$"), plural[0,1].downcase + plural[1..-1])
        singular(Regexp.new("#{plural[0,1].upcase}(?i)#{plural[1..-1]}$"), singular[0,1].upcase + singular[1..-1])
        singular(Regexp.new("#{plural[0,1].downcase}(?i)#{plural[1..-1]}$"), singular[0,1].downcase + singular[1..-1])
      end
    end