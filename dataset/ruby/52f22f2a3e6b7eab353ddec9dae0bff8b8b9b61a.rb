def to_proc
      if args.size > 0
        proc { |*value| fn.call(*value, *args) }
      else
        fn.to_proc
      end
    end