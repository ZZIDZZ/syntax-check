def columns_hash
      colModel.inject({}) { |h, col| h[col.name] = col; h }
    end