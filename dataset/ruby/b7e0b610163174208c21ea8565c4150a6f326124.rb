def time=(time)
      if time < @time
        raise InvalidTime.new("You are trying to put back clock from #{@time} back to #{time}")
      end
      @time = time
      @waiting.keys.sort.each do |timestamp|
        if timestamp > @time
          @next_time = timestamp
          break
        end
        @waiting[timestamp].each { |token| add_token token }
        @waiting.delete timestamp
      end
      @next_time = 0 if @waiting.empty?
      @time
    end