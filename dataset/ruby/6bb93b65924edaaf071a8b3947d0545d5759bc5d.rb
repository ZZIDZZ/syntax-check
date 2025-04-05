def execute(args)
      # create dummy config file
      target_file = @config_file.nil? ? "caramel.rb" : @config_file
      FileUtils.cp(File.dirname(__FILE__) +"/../caramel.rb", target_file)
      if commandparser.verbosity == :normal
        puts "Created new configuration file: #{target_file}"
      end
    end