def each(&block)
      r = true
      while r
        r = next_record
        # nil means EOF
        unless r.nil?
          block.call(r)
        else
          # reached the EOF
          break
        end
      end
    end