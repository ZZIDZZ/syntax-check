def asset_files
      asset_files = []
      Find.find(ENGINE.assets_path).each do |path|
        next if File.directory?(path)
        next if path.include?(ENGINE.stylesheets_sass_path)
        asset_files << path.sub(ENGINE.assets_path, 'assets')
      end
      asset_files
    end