def alias_method!
      klass.send(:define_method, replacement_name, &self)
      klass.send(:alias_method, aliased_name, method_name)
      klass.send(:alias_method, method_name, replacement_name)
    end