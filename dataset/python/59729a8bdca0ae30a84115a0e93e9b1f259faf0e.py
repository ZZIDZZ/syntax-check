def __call_api(self, verb, path, **kargs):
        '''
        Make a HTTP request to the Dominos UK API with the given parameters for
        the current session.

        :param verb func: HTTP method on the session.
        :param string path: The API endpoint path.
        :params list kargs: A list of arguments.
        :return: A response from the Dominos UK API.
        :rtype: response.Response
        '''
        response = verb(self.__url(path), **kargs)

        if response.status_code != 200:
            raise ApiError('{}: {}'.format(response.status_code, response))

        return response