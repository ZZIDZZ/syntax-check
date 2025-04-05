def to_s
      date = []
      date << "#{@years}Y" unless @years.nil?
      date << "#{@months}M" unless @months.nil?
      date << "#{@days}D" unless @days.nil?

      time = []
      time << "#{@hours}H" unless @hours.nil?
      time << "#{@minutes}M" unless @minutes.nil?
      time << "#{@seconds}S" unless @seconds.nil?

      result = nil

      if !date.empty? || !time.empty?
        result = 'P'
        result += date.join unless date.empty?
        result += 'T' + time.join unless time.empty?
      end

      result
    end