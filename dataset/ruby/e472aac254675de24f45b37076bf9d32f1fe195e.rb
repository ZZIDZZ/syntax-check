def index(path)
      @entries = []
      Dir.entries(path).each do |entry|
        relative_path = relative_path(File.join(path, entry))
        if entry != "." && relative_path
          @entries << {:name => entry, :href => relative_path}
        end
      end
      @path = path
      haml :index
    end