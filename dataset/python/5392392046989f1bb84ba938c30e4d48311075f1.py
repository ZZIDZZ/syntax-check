def _ep_error(self, error):
        """The endpoint state machine failed due to protocol error."""
        super(Connection, self)._ep_error(error)
        self._connection_failed("Protocol error occurred.")