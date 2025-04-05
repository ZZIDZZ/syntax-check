def request(self, method, **kwargs):
        """
        Send request to API.

        :param method: `str` method name.
        :returns: `dict` response.
        """
        kwargs.setdefault('v', self.__version)

        if self.__token is not None:
            kwargs.setdefault('access_token', self.__token)

        return requests.get(self.get_url(method, **kwargs)).json()