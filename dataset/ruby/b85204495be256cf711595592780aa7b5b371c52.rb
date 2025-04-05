def method_missing(name, *args, &block)
      obj = __getobj__
      __substitute_self__(obj.__send__(name, *args, &block), obj)
    end