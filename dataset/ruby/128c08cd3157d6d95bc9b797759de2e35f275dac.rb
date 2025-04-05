def add_configuration(config_hash)
      config_hash.each do |key, val|
        instance_eval { instance_variable_set("@#{key}",val) }
        self.class.instance_eval { attr_accessor key }
      end
    end