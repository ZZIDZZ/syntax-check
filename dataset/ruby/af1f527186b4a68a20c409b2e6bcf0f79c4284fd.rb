def save
      return if @data.empty?
      output = {}
      output[:data] = @data
      output[:generated_at] = Time.now.to_s
      output[:started_at] = @started_at
      output[:format_version] = '1.0'
      output[:rails_version] = Rails.version
      output[:rails_path] = Rails.root.to_s

      FileUtils.mkdir_p(@config.output_path)
      filename = "sql_tracker-#{Process.pid}-#{Time.now.to_i}.json"

      File.open(File.join(@config.output_path, filename), 'w') do |f|
        f.write JSON.dump(output)
      end
    end