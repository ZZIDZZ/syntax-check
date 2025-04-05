def delete(self, tag_id):
        """
        Delete a specified anomaly alert tag and its scheduled query

        This method makes 3 requests:

            * One to get the associated scheduled_query_id
            * One to delete the alert
            * One to delete get scheduled query

        :param tag_id: The tag ID to delete
        :type tag_id: str

        :raises: This will raise a
            :class:`ServerException <logentries_api.exceptions.ServerException>`
            if there is an error from Logentries
        """
        this_alert = [tag for tag in self.list_tags() if tag.get('id') == tag_id]

        if len(this_alert) < 1:
            return

        query_id = this_alert[0].get('scheduled_query_id')

        tag_url = 'https://logentries.com/rest/{account_id}/api/tags/{tag_id}'

        self._api_delete(
            url=tag_url.format(
                account_id=self.account_id,
                tag_id=tag_id
            )
        )
        query_url = 'https://logentries.com/rest/{account_id}/api/scheduled_queries/{query_id}'

        self._api_delete(
            url=query_url.format(
                account_id=self.account_id,
                query_id=query_id
            )
        )