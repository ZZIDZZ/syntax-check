def select(css_selector = nil, &block)
      if css_selector
        CssSelection.new(self, css_selector).each(&block)
      else
        Selection.new(self, block)
      end
    end