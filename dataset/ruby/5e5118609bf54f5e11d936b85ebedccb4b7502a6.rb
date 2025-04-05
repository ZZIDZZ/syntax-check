def infer_type(field_name)
      case field_name
      when :email, :time_zone
        field_name
      when %r{(\b|_)password(\b|_)}
        :password
      else
        type_mappings = {text: :textarea}

        db_type = @object.column_for_attribute(field_name).type
        case db_type
        when :text
          :textarea
        when :decimal, :integer, :float
          :numeric
        else
          db_type
        end
      end
    end