def process_report(report)
      file_names = @dangerfile.git.modified_files.map { |file| File.basename(file) }
      file_names += @dangerfile.git.added_files.map { |file| File.basename(file) }
      report.targets.each do |target|
        target.files = target.files.select { |file| file_names.include?(file.name) }
      end

      report
    end