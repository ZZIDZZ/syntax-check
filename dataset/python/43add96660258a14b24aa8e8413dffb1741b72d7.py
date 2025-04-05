def _ping(self, peerid, callid):
        """
        Called from remote to ask if a call made to here is still in progress.
        """
        if not (peerid, callid) in self._remote_to_local:
            logger.warn("No remote call %s from %s. Might just be unfoutunate timing." % (callid, peerid))