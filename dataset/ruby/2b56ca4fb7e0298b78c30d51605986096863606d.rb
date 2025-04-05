def create_address_class(class_name, &block)
      klass = Class.new Address, &block
      Object.const_set class_name, klass
    end