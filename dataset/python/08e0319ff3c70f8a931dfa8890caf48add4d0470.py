def get_url(self, nbfile):
        """Return the url corresponding to the given notebook file

        Parameters
        ----------
        nbfile: str
            The path of the notebook relative to the corresponding
            :attr:``in_dir``

        Returns
        -------
        str or None
            The url or None if no url has been specified
        """
        urls = self.urls
        if isinstance(urls, dict):
            return urls.get(nbfile)
        elif isstring(urls):
            if not urls.endswith('/'):
                urls += '/'
            return urls + nbfile