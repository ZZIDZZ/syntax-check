def multi(self, **kwargs):
        """
        Search the movie, tv show and person collections with a single query.

        Args:
            query: CGI escpaed string.
            page: (optional) Minimum value of 1. Expected value is an integer.
            language: (optional) ISO 639-1 code.
            include_adult: (optional) Toggle the inclusion of adult titles.
                           Expected value is True or False.

        Returns:
            A dict respresentation of the JSON returned from the API.
        """
        path = self._get_path('multi')

        response = self._GET(path, kwargs)
        self._set_attrs_to_values(response)
        return response