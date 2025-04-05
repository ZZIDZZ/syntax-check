def scope(scope_name, scope_enum_keys)
      target_enum = @record_class.defined_enums[@enum_name.to_s]
      sub_enum_values = target_enum.values_at(*scope_enum_keys)

      if @record_class.defined_enum_scopes.has_key?(scope_name)
        fail ArgumentError,
             "Conflicting scope names. A scope named #{scope_name} has already been defined"
      elsif sub_enum_values.include?(nil)
        unknown_key = scope_enum_keys[sub_enum_values.index(nil)]
        fail ArgumentError, "Unknown key - #{unknown_key} for enum #{@enum_name}"
      elsif @record_class.respond_to?(scope_name.to_s.pluralize)
        fail ArgumentError,
             "Scope name - #{scope_name} conflicts with a class method of the same name"
      elsif @record_class.instance_methods.include?("#{scope_name}?".to_sym)
        fail ArgumentError,
             "Scope name - #{scope_name} conflicts with the instance method - #{scope_name}?"
      end

      sub_enum_entries = target_enum.slice(*scope_enum_keys)
      @record_class.defined_enum_scopes[scope_name] = sub_enum_entries

      # 1. Instance method <scope_name>?
      @record_class.send(:define_method, "#{scope_name}?") { sub_enum_entries.include? self.role }

      # 2. The class scope with the scope name
      @record_class.scope scope_name.to_s.pluralize,
                          -> { @record_class.where("#{@enum_name}" => sub_enum_entries.values) }

      @scope_names << scope_name
    end