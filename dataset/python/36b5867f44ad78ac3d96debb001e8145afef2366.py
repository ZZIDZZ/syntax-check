async def readline(self) -> bytes:
        """
        Reads one line

        >>> # Keeps waiting for a linefeed incase there is none in the buffer
        >>> await test.readline()

        :returns: bytes forming a line
        """
        while True:
            line = self._serial_instance.readline()
            if not line:
                await asyncio.sleep(self._asyncio_sleep_time)
            else:
                return line