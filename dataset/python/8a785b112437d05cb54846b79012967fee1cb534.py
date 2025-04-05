def remove(self, name, value):
        """ Remove a value from multiple value parameter. """
        clone = self._clone()
        clone._qsl = [qb for qb in self._qsl if qb != (name, str(value))]
        return clone