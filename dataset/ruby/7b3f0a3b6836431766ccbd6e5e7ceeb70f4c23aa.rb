def leagues(opts={})
      season = opts.fetch(:season) { Time.now.year }

      json_response get("competitions/?season=#{season}")
    end