def read(path)
      schema = nil

      begin
        # TODO: validate this is legitimate JSON Schema
        schema = JSON.parse(IO.read(path))
        raise EmptySchemaError if empty_schema?(schema)
      rescue JSON::JSONError => e
        puts "Encountered an error reading JSON from #{path}"
        puts e.message
        exit 1
      rescue EmptySchemaError
        puts "Schema read from #{path} is empty"
        exit 1
      rescue StandardError => e
        puts e.message
        exit 1
      end

      schema
    end