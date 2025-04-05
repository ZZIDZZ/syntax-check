def fetch_sorted_metric(self, *args, **kwargs):
        """Fetch and sort time series data from OpenTSDB

        Takes the same parameters as `fetch_metric`, but returns a list of
        (timestamp, value) tuples sorted by timestamp.
        """
        return sorted(self.fetch_metric(*args, **kwargs).items(),
            key=lambda x: float(x[0]))