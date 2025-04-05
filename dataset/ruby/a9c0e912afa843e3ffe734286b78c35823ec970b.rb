def post_processing
      @opts.each do |opt|
        raise NoRequiredOption, "The option #{opt} is required" if opt.required? && !@results.key?(opt.to_sym)

        next if opt.required_unless.empty? || @results.key?(opt.to_sym)

        fail_msg = "One of the following options is required: #{opt}, #{opt.required_unless.join(', ')}"

        raise NoRequiredOption, fail_msg unless opt.required_unless.any? do |sym|
          @results.key?(sym)
        end
      end
    end