def to_svg(options={})
      output_to_string_io do |io|
        Cairo::SVGSurface.new(io,
                              full_width(options),
                              full_height(options)) do |surface|
          render(surface, options)
        end
      end
    end