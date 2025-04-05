def close(self):
        """Stop monitoring and close connection."""
        _LOGGER.debug("Closing...")
        self.closed = True
        if self.connected:
            self._writer.close()