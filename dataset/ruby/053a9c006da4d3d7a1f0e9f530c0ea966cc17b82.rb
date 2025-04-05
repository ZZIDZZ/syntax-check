def arel_attributes_values(include_primary_key = true, include_readonly_attributes = true, attribute_names = @attributes.keys)
      attrs = {}
      attribute_names.each do |name|
        if (column = column_for_attribute(name)) && (include_primary_key || !column.primary)
          if include_readonly_attributes || (!include_readonly_attributes && !self.class.readonly_attributes.include?(name))
            value = read_attribute(name)
            if self.class.columns_hash[name].type == :hstore && value && value.is_a?(Hash)
              value = value.to_hstore # Done!
            elsif value && self.class.serialized_attributes.has_key?(name) && (value.acts_like?(:date) || value.acts_like?(:time) || value.is_a?(Hash) || value.is_a?(Array))
              value = value.to_yaml
            end
            attrs[self.class.arel_table[name]] = value
          end
        end
      end
      attrs
    end