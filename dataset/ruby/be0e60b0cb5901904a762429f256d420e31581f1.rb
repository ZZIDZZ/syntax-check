def build_instances(template = nil)
      build_args =
        if template == :template
          [build_options.first.merge(count: 1)]
        else
          build_options
        end

      build_args.map do |args|
        instances = create_instance args
        apply_tags(instances)
        instances
      end.flatten
    end