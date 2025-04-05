def clean!
      stop
      remove_instance_dir!
      FileUtils.remove_entry(config.download_dir, true) if File.exist?(config.download_dir)
      FileUtils.remove_entry(config.tmp_save_dir, true) if File.exist? config.tmp_save_dir
      checksum_validator.clean!
      FileUtils.remove_entry(config.version_file) if File.exist? config.version_file
    end