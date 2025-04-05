def delete(self, *args):
        """Remove the key from the request cache and from memcache."""
        cache = get_cache()
        key = self.get_cache_key(*args)
        if key in cache:
            del cache[key]