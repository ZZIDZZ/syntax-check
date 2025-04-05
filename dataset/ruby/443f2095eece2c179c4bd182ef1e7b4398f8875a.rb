def batches(batch_size:, cursor:)
      @csv.lazy
        .each_slice(batch_size)
        .each_with_index
        .drop(cursor.to_i)
        .to_enum { (count_rows_in_file.to_f / batch_size).ceil }
    end