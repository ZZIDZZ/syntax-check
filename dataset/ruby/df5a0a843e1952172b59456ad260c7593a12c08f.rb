def to_label
      s = '%016x%08x'
      sec = tai_second
      ts = if sec >= 0
        sec + EPOCH
      else
        EPOCH - sec
      end
      Label.new s % [ ts, tai_nanosecond ]
    end