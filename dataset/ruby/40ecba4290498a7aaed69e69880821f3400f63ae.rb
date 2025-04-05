def intercom_script_tag(user_details = nil, options={})
      controller.instance_variable_set(IntercomRails::SCRIPT_TAG_HELPER_CALLED_INSTANCE_VARIABLE, true) if defined?(controller)
      options[:user_details] = user_details if user_details.present?
      options[:find_current_user_details] = !options[:user_details]
      options[:find_current_company_details] = !(options[:user_details] && options[:user_details][:company])
      options[:controller] = controller if defined?(controller)
      ScriptTag.new(options)
    end