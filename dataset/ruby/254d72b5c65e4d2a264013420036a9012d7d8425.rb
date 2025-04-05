def failure(exception_class_or_message, message_or_nil = nil)
      blank.tap do |d|
        d.fail(
          case exception_class_or_message
          when Exception
            raise ArgumentError, "can't specify both exception and message" if message_or_nil
            exception_class_or_message
          when Class
            exception_class_or_message.new(message_or_nil)
          else
            RuntimeError.new(exception_class_or_message.to_s)
          end)
      end
    end