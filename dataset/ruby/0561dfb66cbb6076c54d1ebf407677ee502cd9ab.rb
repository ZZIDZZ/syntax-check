def ascend
      path = @path
      yield self
      while (r = chop_basename(path))
        path, _name = r
        break if path.empty?
        yield self.class.new(del_trailing_separator(path))
      end
    end