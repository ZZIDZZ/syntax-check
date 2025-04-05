def get_event(self):
        """Fetch an event.

        This coroutine will swallow events for removed watches.
        """
        while True:
            prefix = yield from self._stream.readexactly(PREFIX.size)
            if prefix == b'':
                # We got closed, return None.
                return
            wd, flags, cookie, length = PREFIX.unpack(prefix)
            path = yield from self._stream.readexactly(length)

            # All async performed, time to look at the event's content.
            if wd not in self.aliases:
                # Event for a removed watch, skip it.
                continue

            decoded_path = struct.unpack('%ds' % length, path)[0].rstrip(b'\x00').decode('utf-8')
            return Event(
                flags=flags,
                cookie=cookie,
                name=decoded_path,
                alias=self.aliases[wd],
            )