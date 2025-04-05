def store_summary_to_backend(feed, curl)
      headers = HttpHeaders.new(curl.header_str)
      
      # Store info about HTTP retrieval
      summary = { }
      
      summary.merge!(:etag => headers.etag) unless headers.etag.nil?
      summary.merge!(:last_modified => headers.last_modified) unless headers.last_modified.nil?
      
      # Store digest for each feed entry so we can detect new feeds on the next 
      # retrieval
      new_digest_set = feed.entries.map do |e|
        digest_for(e)
      end
      
      new_digest_set = summary_for_feed[:digests].unshift(new_digest_set)
      new_digest_set = new_digest_set[0..@options[:retained_digest_size]]
      
      summary.merge!( :digests => new_digest_set )
      set_summary(summary)
    end