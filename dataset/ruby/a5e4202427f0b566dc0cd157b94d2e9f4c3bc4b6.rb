def points(num_points, prime)
      intercept = @coefficients[0] # the first coefficient is the intercept
      (1..num_points).map do |x|
        y = intercept
        (1...@coefficients.length).each do |i|
          y = (y + @coefficients[i] * x ** i) % prime
        end
        Point.new(x, y)
      end
    end