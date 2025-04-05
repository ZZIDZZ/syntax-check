def send(method, *args, &block)
      if respond_to?(method)
        super
      else
        subject.send(method, *args, &block)
      end
    end