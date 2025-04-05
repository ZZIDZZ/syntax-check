def to_lat format = :dms, dp = 0
      return lat if !format
      GeoUnits::Converter.to_lat lat, format, dp
    end