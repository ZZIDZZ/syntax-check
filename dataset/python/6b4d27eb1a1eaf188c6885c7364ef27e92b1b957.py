def to_str(self, delimiter='|', null='NULL'):
        """
        Sets the current encoder output to Python `str` and returns
        a row iterator.

        :param str null: The string representation of null values
        :param str delimiter: The string delimiting values in the output
            string

        :rtype: iterator (yields ``str``)
        """
        self.export.set_null(null)
        self.export.set_delimiter(delimiter)
        self.options("delimiter", escape_string(delimiter), 2)
        self.options("null", null, 3)
        return self._fetchall(ENCODER_SETTINGS_STRING, coerce_floats=False)