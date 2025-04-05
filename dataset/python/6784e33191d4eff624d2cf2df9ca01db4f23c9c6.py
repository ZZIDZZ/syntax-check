def authenticate_credentials(self, key):
        """Custom authentication to check if auth token has expired."""
        user, token = super(TokenAuthentication, self).authenticate_credentials(key)

        if token.expires < timezone.now():
            msg = _('Token has expired.')
            raise exceptions.AuthenticationFailed(msg)

        # Update the token's expiration date
        token.update_expiry()

        return (user, token)