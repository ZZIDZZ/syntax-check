def write_breaking(text, x, y, width, mode = :left, color = 0, alpha = 0xff, z_index = 0)
      color = (alpha << 24) | color
      text.split("\n").each do |p|
        if mode == :justified
          y = write_paragraph_justified p, x, y, width, color, z_index
        else
          rel =
            case mode
            when :left then 0
            when :center then 0.5
            when :right then 1
            else 0
            end
          y = write_paragraph p, x, y, width, rel, color, z_index
        end
      end
    end