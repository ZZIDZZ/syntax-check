def update(self, **attrs):
        """ Generic method for a resource's Update endpoint.

        Example endpoints:

        * `Update Device Details <https://m2x.att.com/developer/documentation/v2/device#Update-Device-Details>`_
        * `Update Distribution Details <https://m2x.att.com/developer/documentation/v2/distribution#Update-Distribution-Details>`_
        * `Update Collection Details <https://m2x.att.com/developer/documentation/v2/collections#Update-Collection-Details>`_

        :param attrs: Query parameters passed as keyword arguments. View M2X API Docs for listing of available parameters.

        :return: The API response, see M2X API docs for details
        :rtype: dict

        :raises: :class:`~requests.exceptions.HTTPError` if an error occurs when sending the HTTP request
        """
        self.data.update(self.item_update(self.api, self.id, **attrs))
        return self.data