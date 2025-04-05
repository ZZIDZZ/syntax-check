def apply_data_type_coercion(*args)
      coerced_type = check_data_types(*args)
      args.map { |a| a.is_a?(Tensor) ? a : convert_to_tensor(a, dtype: coerced_type) }
    end