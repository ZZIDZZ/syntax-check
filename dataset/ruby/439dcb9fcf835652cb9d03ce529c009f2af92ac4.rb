def add_field(value)
      return if value.nil?
      return if value.strip.empty?

      # Increment the variable field count
      self.variable_fields_count += 1

      # Add the field
      label_data.push('^FN' + variable_fields_count.to_s +
                      '^FD' + value + '^FS')
    end