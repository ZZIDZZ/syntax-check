def emit(self, record):

        """ pymongo expects a dict """
        msg = self.format(record)

        if not isinstance(msg, dict):
            msg = json.loads(msg)

        self.collection.insert(msg)