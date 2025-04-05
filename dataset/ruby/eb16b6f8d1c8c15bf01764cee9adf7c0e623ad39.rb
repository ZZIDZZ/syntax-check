def days_to_week_start(start_day = Date.beginning_of_week)
      start_day_number = DAYS_INTO_WEEK[start_day]
      current_day_number = wday != 0 ? wday - 1 : 6
      (current_day_number - start_day_number) % 7
    end