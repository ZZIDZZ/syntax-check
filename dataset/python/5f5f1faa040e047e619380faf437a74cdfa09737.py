def put_text(self, key, contents):
        """Store the given text contents so that they are later retrievable by
        the given key."""

        self._blobservice.create_blob_from_text(
            self.uuid,
            key,
            contents
        )