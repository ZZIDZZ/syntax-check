def addStream(self, stream, t1=None, t2=None, limit=None, i1=None, i2=None, transform=None):
        """Adds the given stream to the query construction. The function supports both stream
        names and Stream objects."""
        params = query_maker(t1, t2, limit, i1, i2, transform)

        params["stream"] = get_stream(self.cdb, stream)

        # Now add the stream to the query parameters
        self.query.append(params)