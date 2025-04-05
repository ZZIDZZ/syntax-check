def delete(self, endpoint, headers):
        """
        Method to delete an item or all items

        headers['If-Match'] must contain the _etag identifier of the element to delete

        :param endpoint: endpoint (API URL)
        :type endpoint: str
        :param headers: headers (example: Content-Type)
        :type headers: dict
        :return: response (deletion information)
        :rtype: dict
        """
        response = self.get_response(method='DELETE', endpoint=endpoint, headers=headers)

        logger.debug("delete, response: %s", response)
        if response.status_code != 204:  # pragma: no cover - should not happen ...
            resp = self.decode(response=response)

        resp = {"_status": "OK"}
        return resp