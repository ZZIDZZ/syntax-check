def get_concept(self, conceptId, lang='en'):
        """ Fetch the concept from the Knowledge base

        Args:
              id (str): The concept id to be fetched, it can be Wikipedia
                page id or Wikiedata id.

        Returns:
            dict, int: A dict containing the concept information; an integer
                representing the response code.
        """
        url = urljoin(self.concept_service + '/', conceptId)

        res, status_code = self.get(url, params={'lang': lang})

        if status_code != 200:
            logger.debug('Fetch concept failed.')

        return self.decode(res), status_code