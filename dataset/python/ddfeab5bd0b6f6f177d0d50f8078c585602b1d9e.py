def iterkeys(self):
        """
        Enumerate the keys found at any scope for the current plugin.

        rtype: Generator[str]
        """
        visited_keys = set()
        try:
            for key in self.idb.iterkeys():
                if key not in visited_keys:
                    yield key
                    visited_keys.add(key)
        except (PermissionError, EnvironmentError):
            pass

        try:
            for key in self.directory.iterkeys():
                if key not in visited_keys:
                    yield key
                    visited_keys.add(key)
        except (PermissionError, EnvironmentError):
            pass

        try:
            for key in self.user.iterkeys():
                if key not in visited_keys:
                    yield key
                    visited_keys.add(key)
        except (PermissionError, EnvironmentError):
            pass

        try:
            for key in self.system.iterkeys():
                if key not in visited_keys:
                    yield key
                    visited_keys.add(key)
        except (PermissionError, EnvironmentError):
            pass