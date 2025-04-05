def setup_streaming
      stream_uri = @client.instance()
                     .attributes['urls']['streaming_api'].gsub(/^wss?/, 'https')
      @streamer = Mastodon::Streaming::Client.new(base_url: stream_uri,
                                                  bearer_token: ENV['TOKEN'])
    end