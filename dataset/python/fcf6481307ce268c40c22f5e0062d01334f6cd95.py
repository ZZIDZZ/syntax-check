def load(self):
        """
        Force reloading the data from the file.
        All data in the in-memory dictionary is discarded.
        This method is called automatically by the constructor, normally you
        don't need to call it.
        """
        self._check_open()
        try:
            data = json.load(self.file, **self.load_args)
        except ValueError:
            data = {}
        if not isinstance(data, dict):
            raise ValueError('Root JSON type must be dictionary')
        self.clear()
        self.update(data)