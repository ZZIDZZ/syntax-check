def find(icon)
      str = icon.to_s.downcase
      file = DB.files[str] ||
               DB.files[str.sub(/\.svg$/,'')] ||
               not_found(str, icon)
      Icon.new(file)
    end