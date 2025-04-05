def with_ignored_exceptions(self, *ignored_exceptions):
        """
        Set a list of exceptions that should be ignored inside the wait loop.
        """
        for exception in ignored_exceptions:
            self._ignored_exceptions = self._ignored_exceptions + (exception,)
        return self