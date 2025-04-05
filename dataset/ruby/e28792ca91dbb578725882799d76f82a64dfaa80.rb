def atomic_write(path)
      tmp = Tempfile.new(File.basename(path))
      yield(tmp)
      tmp.close
      chmod(tmp.path, 0o644)
      mv(tmp.path, path)
    ensure
      rm_if_necessary(tmp.path)
    end