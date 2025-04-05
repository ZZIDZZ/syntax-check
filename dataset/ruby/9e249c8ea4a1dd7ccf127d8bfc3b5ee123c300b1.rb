def configfile_hash

      config  = {}
      begin
        json    = File.read(configfile)
        config  = JSON.parse(json)
      rescue Errno::ENOENT
        # depending on whether the instance has been saved or not, we may not
        # yet have a configfile - allow to proceed
        @logger.debug "#{configfile} does not exist"
        @force_save = true
      rescue JSON::ParserError
        # swallow parse errors so that we can destroy and recreate automatically
        @logger.debug "JSON parse error in #{configfile}"
        @force_save = true
      end
      config
    end