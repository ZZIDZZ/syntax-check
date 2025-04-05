def handle_schema(parent_schema, obj)
      if obj.is_a?(Hash)
        schema_uri = parent_schema.uri.dup
        schema = JSON::Schema.new(obj, schema_uri, parent_schema.validator)
        if obj['id']
          self.class.add_schema(schema)
        end
        build_schemas(schema)
      end
    end