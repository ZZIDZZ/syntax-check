def coords_of_neighbors(x, y)
        coords_of_neighbors = []
        (x - 1).upto(x + 1).each do |neighbors_x|
          (y - 1).upto(y + 1).each do |neighbors_y|
            next if (x == neighbors_x) && (y == neighbors_y)
            coords_of_neighbors << [neighbors_x, neighbors_y]
          end
        end
        coords_of_neighbors
      end