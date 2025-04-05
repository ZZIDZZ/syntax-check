def each_param(&block)
      ancestors.reverse_each do |ancestor|
        if ancestor.included_modules.include?(Parameters)
          ancestor.params.each_value(&block)
        end
      end

      return self
    end