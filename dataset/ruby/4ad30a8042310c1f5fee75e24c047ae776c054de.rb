def validates(*args, &block)
      validation(name: :default, inherit: true) { validates *args, &block }
    end