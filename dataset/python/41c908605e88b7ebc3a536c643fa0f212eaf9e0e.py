def historical_content(self, content_id, version):
        """Get the snapshot of a content for the given version.

        :param content_id: fetch the snapshot of this content
        :param version: snapshot version of the content
        """
        resource = self.RCONTENTS + '/' + str(content_id)

        params = {
            self.PVERSION: version,
            self.PSTATUS: self.VHISTORICAL,
            self.PEXPAND: ','.join(self.VEXPAND)
        }

        # Only one item is returned
        response = [response for response in self._call(resource, params)]
        return response[0]