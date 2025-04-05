def configure_objects(confs={})
      confs.each do |key,opts|
        key = key.to_sym
        @object_configs[key] ={} unless has_config?(key)
        @object_configs[key].merge!(opts)
      end
    end