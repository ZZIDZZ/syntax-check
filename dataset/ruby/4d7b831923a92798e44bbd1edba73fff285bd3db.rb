def read_input_by_6_words
      word_arr = []

      while true
        line = stream.gets
        if line.nil?
          break # EOF
        end

        line.scan(/\S+/) do |word|
          word_arr << word

          # return the array if we have accumulated 6 words
          if word_arr.length == 6
            yield word_arr
            word_arr.clear
          end
        end
      end

      # yield whatever we have left, if anything
      if !word_arr.empty?
        yield word_arr
      end
    end