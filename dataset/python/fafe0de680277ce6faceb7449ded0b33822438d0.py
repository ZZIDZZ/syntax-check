def health(self, params=None):
        """Coroutine. Queries cluster Health API.

        Returns a 2-tuple, where first element is request status, and second
        element is a dictionary with response data.

        :param params: dictionary of query parameters, will be handed over to
            the underlying :class:`~torando_elasticsearch.AsyncHTTPConnection`
            class for serialization

        """
        status, data = yield self.transport.perform_request(
            "GET", "/_cluster/health", params=params)
        raise gen.Return((status, data))