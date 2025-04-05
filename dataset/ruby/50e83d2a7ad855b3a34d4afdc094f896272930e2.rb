def say(message, color=nil)
      @shell ||= Thor::Shell::Basic.new
      @shell.say message, color
    end