def execute_screens(control, timing = :before_post_process)
      screens = case timing
        when :after_post_process
          control.after_post_process_screens
        else # default to before post-process screens
          control.screens
        end
      [:fatal,:error,:warn].each do |type|
        screens[type].each do |block|
          begin
            block.call
          rescue => e
            case type
            when :fatal
              raise FatalScreenError, e
            when :error
              raise ScreenError, e
            when :warn
              say "Screen warning: #{e}"
            end
          end
        end
      end
    end