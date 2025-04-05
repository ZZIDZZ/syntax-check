def to_h
      @values.inject(Hash.new) do |h, a|
        tag, val = a
        h[Values.tag_map[tag]] = convert(Values.unify_tag(tag), val)
        h
      end
    end