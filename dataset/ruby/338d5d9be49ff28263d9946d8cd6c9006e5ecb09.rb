def get_httparty_config(options)
      return if options.nil?

      httparty = Gitlab::CLI::Helpers.yaml_load(options)
      raise ArgumentError, 'HTTParty config should be a Hash.' unless httparty.is_a? Hash

      Gitlab::CLI::Helpers.symbolize_keys httparty
    end