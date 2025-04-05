def get_agent(self, reactor=None, contextFactory=None):
        """
        Returns an IAgent that makes requests to this fake server.
        """
        return ProxyAgentWithContext(
            self.endpoint, reactor=reactor, contextFactory=contextFactory)