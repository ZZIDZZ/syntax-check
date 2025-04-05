def representer_for(format, model, options={})
      options.delete(:represent_with) || self.class.represents_options.for(format, model, controller_path)
    end