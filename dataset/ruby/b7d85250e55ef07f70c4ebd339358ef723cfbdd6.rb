def method_missing meth, *args, &blk
      if meth.to_s.end_with?('?') && Status.include?(s = meth.to_s.chop.to_sym)
        self[:status] == s
      else
        super
      end
    end