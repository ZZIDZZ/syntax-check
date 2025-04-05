def _read_loop(self):
        """
        Coroutine which gathers bytes sent by the server
        and feeds them to the protocol parser.
        In case of error while reading, it will stop running
        and its task has to be rescheduled.
        """
        while True:
            try:
                should_bail = self.is_closed or self.is_reconnecting
                if should_bail or self._io_reader is None:
                    break
                if self.is_connected and self._io_reader.at_eof():
                    if self._error_cb is not None:
                        yield from self._error_cb(ErrStaleConnection)
                    yield from self._process_op_err(ErrStaleConnection)
                    break

                b = yield from self._io_reader.read(DEFAULT_BUFFER_SIZE)
                yield from self._ps.parse(b)
            except ErrProtocol:
                yield from self._process_op_err(ErrProtocol)
                break
            except OSError as e:
                yield from self._process_op_err(e)
                break
            except asyncio.CancelledError:
                break