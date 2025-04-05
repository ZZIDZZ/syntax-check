def valid_source_file? filename
      suffixs = [".h", ".c", ".m", ".mm", ".swift", ".cpp"]
      suffixs.each do |suffix|
        return true if filename.name.end_with? suffix
      end
      return false
    end