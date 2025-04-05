def parse_service_name(path)
      parts = Pathname.new(path).each_filename.to_a.reverse!
      # Find the last segment not in common segments, fall back to the last segment.
      parts.find {|seg| !COMMON_SEGMENTS[seg] } || parts.first
    end