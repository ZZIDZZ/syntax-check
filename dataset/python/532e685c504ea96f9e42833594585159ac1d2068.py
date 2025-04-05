def getall(self, key, default=[]):
        """Return the list of all values for the specified key.

        Arguments:
          key (object): Key
          default (list): Default value to return if the key does not
            exist, defaults to ``[]``, i.e. an empty list.

        Returns:
          list: List of all values for the specified key if the key
          exists, ``default`` otherwise.
        """
        return self.data[key] if key in self.data else default