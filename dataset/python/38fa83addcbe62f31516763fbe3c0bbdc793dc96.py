def is_current(self):
        """``True`` if current request has same endpoint with the item.

        The property should be used in a bound request context, or the
        :class:`RuntimeError` may be raised.
        """
        if not self.is_internal:
            return False  # always false for external url
        has_same_endpoint = (request.endpoint == self.endpoint)
        has_same_args = (request.view_args == self.args)
        return has_same_endpoint and has_same_args