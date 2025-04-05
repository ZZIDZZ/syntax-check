def on_event(channel_id, method, callable=nil, &block)
      handler = block || callable
      raise ArgumentError, "expected block or callable as the event handler" \
        unless handler.respond_to?(:call)
      
      @event_handlers[Integer(channel_id)][method.to_sym] = handler
      handler
    end