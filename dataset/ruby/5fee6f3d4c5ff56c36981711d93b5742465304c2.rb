def save_version?
      if_condition = @record.paper_trail_options[:if]
      unless_condition = @record.paper_trail_options[:unless]
      (if_condition.blank? || if_condition.call(@record)) && !unless_condition.try(:call, @record)
    end