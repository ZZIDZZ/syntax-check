def output(elapsed)
      case @result
      when MATCH_SUCCESS
        color = :green
        header = 'OK'
      when MATCH_FAILURE
        color = :red
        header = 'FAIL'
      when MATCH_WARNING
        color = :light_red
        header = 'WARN'
      end
      header = header.ljust(12).colorize(color)
      str_elapsed = "#{elapsed.round(2)}s"
      name = @name.to_s[0..17]
      puts "#{header}   #{name.ljust(20)}   #{str_elapsed.ljust(9)} #{@message}"
    end