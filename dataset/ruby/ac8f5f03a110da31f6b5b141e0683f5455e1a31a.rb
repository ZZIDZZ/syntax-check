def check_file(file)
      puts "Checking #{file}..." if verbose == true
      # spell check each line separately so we can report error locations properly
      lines = File.read(file).split("\n")

      success = true
      lines.each_with_index do |text, index|
        misspelled = misspelled_on_line(text)
        next if misspelled.empty?

        success = false
        print_misspelled(misspelled, index, text)
      end

      success
    end