def flush(self):
        """Write down buffer to the file."""
        if not self.is_output():
            return

        count = len(self._write_buff)
        if count == 0:
            return

        encodeVarint(self._fd.write, count, True)

        for obj in self._write_buff:
            obj_str = obj.SerializeToString()
            encodeVarint(self._fd.write, len(obj_str), True)
            self._fd.write(obj_str)

        self._write_buff = []