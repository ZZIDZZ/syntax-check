def _write_hex_long(self, data, pos, value):
        """
        Writes an unsigned long value across a byte array.

        :param data: the buffer to write the value to
        :type data: bytearray
        :param pos: the starting position
        :type pos: int
        :param value: the value to write
        :type value: unsigned long
        """
        self._write_hex_byte(data, pos + 0, (value >> 56) & 0xff)
        self._write_hex_byte(data, pos + 2, (value >> 48) & 0xff)
        self._write_hex_byte(data, pos + 4, (value >> 40) & 0xff)
        self._write_hex_byte(data, pos + 6, (value >> 32) & 0xff)
        self._write_hex_byte(data, pos + 8, (value >> 24) & 0xff)
        self._write_hex_byte(data, pos + 10, (value >> 16) & 0xff)
        self._write_hex_byte(data, pos + 12, (value >> 8) & 0xff)
        self._write_hex_byte(data, pos + 14, (value & 0xff))