def get_credentials(self):
        """Gets valid user credentials from storage.

        If nothing has been stored, or if the stored credentials are invalid,
        the OAuth2 flow is completed to obtain the new credentials.

        Returns:
            Credentials, the obtained credential.
        """
        with self.AUTHENTICATION_LOCK:
            log.info('Starting authentication for %s', self.target)
            store = oauth2client.file.Storage(self.credentials_path)
            credentials = store.get()
            if not credentials or credentials.invalid:
                log.info("No valid login. Starting OAUTH flow.")
                flow = oauth2client.client.flow_from_clientsecrets(self.client_secret_path, self.SCOPES)
                flow.user_agent = self.APPLICATION_NAME
                flags = oauth2client.tools.argparser.parse_args([])
                credentials = oauth2client.tools.run_flow(flow, store, flags)
                log.info('Storing credentials to %r', self.credentials_path)
            return credentials