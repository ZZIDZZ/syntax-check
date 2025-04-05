def _load(options = {})
      # Clean up and symbolize all the keys then merge that with the existing properties
      options.keys.each do |key|
        property_name = key.to_s.underscore.to_sym
        if respond_to? "#{property_name}="
          send("#{property_name}=",options.delete(key))
        else
          options[property_name] = options.delete(key)
        end
      end

      properties.merge! options
    end