def storage(self):
        """Getter for various Storage variables"""
        if self._storage is None:
            api = "SYNO.Storage.CGI.Storage"
            url = "%s/entry.cgi?api=%s&version=1&method=load_info" % (
                self.base_url,
                api)
            self._storage = SynoStorage(self._get_url(url))
        return self._storage