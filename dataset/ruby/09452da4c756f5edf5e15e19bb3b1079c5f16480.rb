def render_content_files(dest_dir, options)
      view = Render::View.new(self, @config)
      @config.locales.each do |file_locale|
        content_file = content_file(file_locale)
        next unless content_file
        dest = destination_file(dest_dir, file_locale)
        unless Dir.exist?(File.dirname(dest))
          FileUtils.mkdir_p(File.dirname(dest))
        end
        if options[:force] || !File.exist?(dest) || File.mtime(content_file) > File.mtime(dest)
          File.open(dest, 'w') do |f|
            layout = @props.layout || 'default'
            f.write view.render({page: self, layout: layout}, {locale: file_locale})
          end
        end
      end
    end