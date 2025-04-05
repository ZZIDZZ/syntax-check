def where(method)
      @complete, @result = nil, nil
      z = find_or_next(method) { |method| 
        self.find{|m| m.eql?(method) }
      }.find_or_next(method) { |method|
        self.find{|m| m.eql0?(method) }
      }.find_or_next(method) { |method|
        self.find{|m| m.like?(method) }
      }.find_or_next(method) {|method| 
        self.find{|m| m.like0?(method) }
      }.get
    end