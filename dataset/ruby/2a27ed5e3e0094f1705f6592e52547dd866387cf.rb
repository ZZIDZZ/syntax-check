def fetch_module
    FileUtils.mkdir_p git_path
    RIM::git_session(git_path) do |s|
      if !File.exist?(git_path + "/config")
        s.execute("git clone --mirror #{@remote_url} #{git_path}") do |out, e|
          raise RimException.new("Remote repository '#{@remote_url}' of module '#{@module_info.local_path}' not found.") if e
        end
      else
        s.execute("git remote update")
      end
    end
    git_path
  end