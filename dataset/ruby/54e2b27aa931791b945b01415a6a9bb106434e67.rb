def invalid_fts_filters(filters)
      filters.select { |filter|
        category, name, value = filter.values_at('category', 'name', 'value')
        category == 'fts' && name == 'search' && value.to_s.length <= 1
      }.map { |invalid_fts_filter|
        error = <<-MSG.gsub(/^\s+/, '').strip
          Full-text search filter values must be larger than one.
        MSG
        invalid_fts_filter.merge(:error => error)
      }
    end