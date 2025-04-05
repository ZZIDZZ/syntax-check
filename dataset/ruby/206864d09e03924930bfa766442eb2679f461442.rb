def find_columns(validate)
      @found_columns = []
      prefix = "#{filename.yellow}:"

      required = @definition.required_columns
      unless required.empty?
        Log.info { "#{prefix} #{'required columns'.magenta}" } if validate

        missing = check_columns(validate, prefix, required, :green, :red)
        raise RequiredColumnsMissing, missing if validate && missing.present?
      end

      optional = @definition.optional_columns
      unless optional.empty?
        Log.info { "#{prefix} #{'optional columns'.cyan}" } if validate
        check_columns(validate, prefix, optional, :cyan, :light_yellow)
      end

      cols = @definition.columns.collect(&:name)
      headers = @csv_headers.select { |h| cols.include?(h) }

      @col_names ||= @found_columns.map(&:name)
      ::Hash[*headers.inject([]) { |list, c| list << c << @definition[c] }]
    end