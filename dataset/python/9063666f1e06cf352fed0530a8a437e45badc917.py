def tenant_token(self):
        """The cached token of the current tenant."""
        rv = getattr(self, '_tenant_token', None)
        if rv is None:
            rv = self._tenant_token = self.tenant.get_token()
        return rv