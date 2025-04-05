def location_filter(location)
      return nil if location.nil?
      location.\
        strip.\
        downcase.\
        tr('#"<>[]', '').\
        gsub(/^[0-9,\/().:]*/, '').\
        gsub(/ +/, ' ').\
        gsub(/,([a-z]*)/, '\1')
    end