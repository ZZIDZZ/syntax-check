def sanitize_keys!
      # Symbolize
      manipulate_keys! { |key_name| key_name.is_a?(Symbol) ? key_name : key_name.to_sym }

      # Underscoreize (because Cocaine doesn't like hyphens)
      manipulate_keys! { |key_name| key_name.to_s.tr('-', '_').to_sym }
    end