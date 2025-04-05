def method_missing(name, *args, &block)
      return super unless @table.accessors?

      name              =~ /^(\w+)(=)?$/
      name_mod, assign  = $1, $2
      index             = @table.index_for_accessor(name_mod)
      arg_count         = assign ? 1 : 0

      return super unless index

      raise ArgumentError, "Wrong number of arguments (#{args.size} for #{arg_count})" if args.size > arg_count

      if assign then
        @data[index] = args.first
      else
        @data[index]
      end
    end