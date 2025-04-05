def _check_scheme(self, config):
        """
        check for a valid scheme

        raise AttributeError if missing
        raise ValueError if not valid
        """
        try:
            scheme = config.get(
                escape_for_ini('keyring-setting'),
                escape_for_ini('scheme'),
            )
        except (configparser.NoSectionError, configparser.NoOptionError):
            raise AttributeError("Encryption scheme missing")

        # extract AES mode
        aesmode = scheme[-3:]
        if aesmode not in self._get_mode():
            raise ValueError("Encryption scheme invalid: %s" % (aesmode))

        # setup AES mode
        self.aesmode = aesmode

        # remove pointless crypto module name
        if scheme.startswith('PyCryptodome '):
            scheme = scheme[13:]

        # check other scheme properties
        if scheme != self.scheme:
            raise ValueError("Encryption scheme mismatch "
                             "(exp.: %s, found: %s)" % (self.scheme, scheme))