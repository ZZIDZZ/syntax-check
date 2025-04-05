def option_group(*args)
      selector = if args.first.respond_to?(:elements)
                   args.first
                 else
                   extract_selector(args)
                 end
      OptionGroup.new(self, selector)
    end