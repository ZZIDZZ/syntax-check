def lines_selector_for(target, attributes)
      if (klass = @selectors.find { |s| s.handles? target, attributes })
        klass.new(target, attributes, logger: logger)
      end
    end