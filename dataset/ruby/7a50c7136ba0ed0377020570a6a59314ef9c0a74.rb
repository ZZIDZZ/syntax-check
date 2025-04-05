def watch(options={})
      build(options)
      require 'listen'

      trap("SIGINT") {
        puts "\nspark_engine watcher stopped. Have a nice day!"
        exit!
      }

      @threads.concat SparkEngine.load_plugin.watch(options)
    end