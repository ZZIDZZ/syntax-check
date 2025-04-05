def push(gem, method, options = {})
      push_command = PUSH_METHODS[method.to_s] or raise "Unknown Gem push method #{method.inspect}."
      push_command += [gem]
      push_command += ["--as", options[:as]] if options[:as]
      @cli_facade.execute(*push_command)
    end