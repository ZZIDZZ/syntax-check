def parse_mead(*args)
      parts = @mead.split('-')
      args.each_with_index do |field, i|
        instance_variable_set('@' + field, parts[i])
      end
    end