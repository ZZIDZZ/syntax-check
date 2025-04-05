def list_subscriptions(self, user_token):
        """
        Get the list of the topics which a user is subscribed to.

        :param str user_token: The token of the user.
        :return: The list of the topics.
        :rtype: list
        :raises `requests.exceptions.HTTPError`: If an HTTP error occurred.
        """
        response = _request('GET',
            url=self.url_v1('/user/subscriptions'),
            user_agent=self.user_agent,
            user_token=user_token,
        )
        _raise_for_status(response)

        return response.json()['topics']