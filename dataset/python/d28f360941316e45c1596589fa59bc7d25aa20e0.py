def add_value(self, name, value):
        """
        Add a new value to the list.

        :param str name: name of the value that is being parsed
        :param str value: value that is being parsed
        :raises ietfparse.errors.MalformedLinkValue:
            if *strict mode* is enabled and a validation error
            is detected

        This method implements most of the validation mentioned in
        sections 5.3 and 5.4 of :rfc:`5988`.  The ``_rfc_values``
        dictionary contains the appropriate values for the attributes
        that get special handling.  If *strict mode* is enabled, then
        only values that are acceptable will be added to ``_values``.

        """
        try:
            if self._rfc_values[name] is None:
                self._rfc_values[name] = value
            elif self.strict:
                if name in ('media', 'type'):
                    raise errors.MalformedLinkValue(
                        'More than one {} parameter present'.format(name))
                return
        except KeyError:
            pass

        if self.strict and name in ('title', 'title*'):
            return

        self._values.append((name, value))