def _split_url(url):
        """
        Splits given url to url base and params converted to list of tuples.
        """

        split = parse.urlsplit(url)
        base = parse.urlunsplit((split.scheme, split.netloc, split.path, 0, 0))
        params = parse.parse_qsl(split.query, True)

        return base, params