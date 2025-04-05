def log msg = "", obj = nil, level: Level::DEBUG, classname: nil, &blk
      log_frames msg, obj, classname: classname, level: level, nframes: 0, &blk
    end