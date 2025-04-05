def multi_search(queries)
      unless queries.kind_of?(Hash)
        raise ArgumentError, "Argument must be a Hash of named queries (#{queries.class} given)"
      end

      stmts       = []
      bind_values = []

      queries.each do |key, args|
        str, *values = @builder.select(*extract_query_data(args))
        stmts.push(str, "SHOW META")
        bind_values.push(*values)
      end

      rs = @conn.multi_query(stmts.join(";\n"), *bind_values)

      Hash[].tap do |result|
        queries.keys.each do |key|
          records, meta = rs.shift, rs.shift
          result[key] = meta_to_hash(meta).tap do |r|
            r[:records] = records.map { |hash|
              hash.inject({}) { |o, (k, v)| o.merge!(k.to_sym => v) }
            }
          end
        end
      end
    end