def valid_for_scope?(update_params)
        return true if dynamic_scaffold.scope_options[:changeable]

        result = true
        scope_params.each do |key, value|
          if update_params.key?(key) && update_params[key] != value
            result = false
            break
          end
        end
        result
      end