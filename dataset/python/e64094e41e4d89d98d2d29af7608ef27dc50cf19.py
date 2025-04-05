def remove_interceptor(self, name):
        """
        Removes a specific interceptor by name.

        Arguments:
            name (str): interceptor name to disable.

        Returns:
            bool: `True` if the interceptor was disabled, otherwise `False`.
        """
        for index, interceptor in enumerate(self.interceptors):
            matches = (
                type(interceptor).__name__ == name or
                getattr(interceptor, 'name') == name
            )
            if matches:
                self.interceptors.pop(index)
                return True
        return False