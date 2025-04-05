def get_authorization(self):
        """Get authorization object representing status of authentication."""
        auth = self.authorization_class()
        header = self.get_authorization_header()
        if not header or not header.split:
            return auth
        header = header.split()
        if len(header) > 1 and header[0] == 'Bearer':
            auth.is_oauth = True
            access_token = header[1]
            self.validate_access_token(access_token, auth)
            if not auth.is_valid:
                auth.error = 'access_denied'
        return auth