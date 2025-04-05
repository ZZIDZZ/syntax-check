def each

      (0..size-1).each do |i|
        pk = @list[i]
        if @opts[:pk_only]
          yield(pk)
        else
          val = @table[pk]
          val[:pk] = pk unless @opts[:no_pk]
          yield(val)
        end
      end
    end