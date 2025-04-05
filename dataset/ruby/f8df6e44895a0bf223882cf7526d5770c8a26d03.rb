def scan_spec(fmt_string)
      until fmt_string.empty?
        if (match_data = PARSE_REGEX.match(fmt_string))
          mid = match_data.to_s
          pre = match_data.pre_match

          @specs << FormatLiteral.new(pre) unless pre.empty?
          @specs << case
                    when match_data[:var] then FormatVariable.new(mid)
                    when match_data[:set] then FormatSet.new(mid)
                    when match_data[:rgx] then FormatRgx.new(mid)
                    when match_data[:per] then FormatLiteral.new("\%")
                    else fail "Impossible case in scan_spec."
                    end
          fmt_string = match_data.post_match
        else
          @specs << FormatLiteral.new(fmt_string)
          fmt_string = ""
        end
      end
    end