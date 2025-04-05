def method_missing(meth, opts = {})
      if meth.to_s == 'to_ary'
        super
      end

      if meth.to_s.end_with? '!'
        deep_merge_options meth[0..-2].to_sym, opts
      else
        merge_options meth, opts
      end
    end