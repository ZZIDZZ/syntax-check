def getEvents(self, min_nr=1, nr=None, timeout=None):
        """
        Returns a list of event data from submitted IO blocks.

        min_nr (int, None)
            When timeout is None, minimum number of events to collect before
            returning.
            If None, waits for all submitted events.
        nr (int, None)
            Maximum number of events to return.
            If None, set to maxevents given at construction or to the number of
            currently submitted events, whichever is larger.
        timeout (float, None):
            Time to wait for events.
            If None, become blocking.

        Returns a list of 3-tuples, containing:
        - completed AIOBlock instance
        - res, file-object-type-dependent value
        - res2, another file-object-type-dependent value
        """
        if min_nr is None:
            min_nr = len(self._submitted)
        if nr is None:
            nr = max(len(self._submitted), self._maxevents)
        if timeout is None:
            timeoutp = None
        else:
            sec = int(timeout)
            timeout = libaio.timespec(sec, int((timeout - sec) * 1e9))
            timeoutp = byref(timeout)
        event_buffer = (libaio.io_event * nr)()
        actual_nr = libaio.io_getevents(
            self._ctx,
            min_nr,
            nr,
            event_buffer,
            timeoutp,
        )
        return [
            self._eventToPython(event_buffer[x])
            for x in xrange(actual_nr)
        ]