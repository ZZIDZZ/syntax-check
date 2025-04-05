def close(self):
        """
        Closes the job manager. No more jobs will be assigned, no more job sets
        will be added, and any queued or active job sets will be cancelled.
        """

        if self._closed:
            return

        self._closed = True
        if self._active_js is not None:
            self._active_js.cancel()
        for js in self._js_queue:
            js.cancel()