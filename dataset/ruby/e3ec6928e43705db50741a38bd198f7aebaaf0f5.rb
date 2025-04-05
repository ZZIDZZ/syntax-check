def group!(*args, &block)
    return unless block_given?

    `#@native.groupCollapsed.apply(#@native, args)`

    begin
      if block.arity == 0
        instance_exec(&block)
      else
        block.call(self)
      end
    ensure
      `#@native.groupEnd()`
    end
  end