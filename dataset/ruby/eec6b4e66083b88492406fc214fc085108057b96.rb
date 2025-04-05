def interpolate interpolant
      case @opts[:type]
      when :linear
        for_each (interpolant) { |x| linear_interpolation(x)  }
      when :cubic
        cubic_spline_interpolation interpolant
      else
        raise ArgumentError, "1 D interpolation of type #{@opts[:type]} not supported"
      end
    end