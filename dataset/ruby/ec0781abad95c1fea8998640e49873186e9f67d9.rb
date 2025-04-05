def alt_field(number, ref_field, &block)
      unless @fields_by_name.include?(ref_field)
        raise "Unknown ref_field: #{ref_field}"
      end

      field = AltField.new(self, ref_field, &block)
      register_field_by_number(field, number)
    end