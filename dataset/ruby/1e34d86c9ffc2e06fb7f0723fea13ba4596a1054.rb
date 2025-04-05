def set_upload_limit torrent_hash, limit
      query = ["hashes=#{torrent_hash}", "limit=#{limit}"]

      options = {
        body: query.join('&')
      }

      self.class.post('/command/setTorrentsUpLimit', options)
    end