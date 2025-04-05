def add_value(name, type, subtype = nil)
      if type.class == RustyJson::RustStruct || subtype.class == RustyJson::RustStruct
        if type.class == RustyJson::RustStruct
          t = type
          type = type.name
          struct = t
        elsif subtype.class == RustyJson::RustStruct
          s = subtype
          subtype = subtype.name
          struct = s
        end
        @structs << struct
        RustStruct.add_type(struct.name, struct.name)
      end
      @values[name] = [type, subtype]
      true
    end