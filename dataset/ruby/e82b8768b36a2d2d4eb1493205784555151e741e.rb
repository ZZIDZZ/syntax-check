def fetch
      self.version = begin
        ver = cache.fetch(CACHE_VERSION_KEY) do
          {'version' => Tml.config.cache[:version] || 'undefined', 't' => cache_timestamp}
        end
        validate_cache_version(ver)
      end
    end