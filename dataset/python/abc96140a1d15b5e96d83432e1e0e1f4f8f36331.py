def _update_secrets(self):
        '''update secrets will take a secrets credential file
           either located at .sregistry or the environment variable
           SREGISTRY_CLIENT_SECRETS and update the current client 
           secrets as well as the associated API base. This is where you
           should do any customization of the secrets flie, or using
           it to update your client, if needed.
        '''
        # Get a setting for client myclient and some variable name VAR. 
        # returns None if not set
        setting = self._get_setting('SREGISTRY_MYCLIENT_VAR')

        # Get (and if found in environment (1) settings (2) update the variable
        # It will still return None if not set
        setting = self._get_and_update_setting('SREGISTRY_MYCLIENT_VAR')

        # If you have a setting that is required and not found, you should exit.

        # Here is how to read all client secrets
        self.secrets = read_client_secrets()
        
        # If you don't want to use the shared settings file, you have your own.
        # Here is how to get if the user has a cache for you enabled, this
        # returns a path (enabled) or None (disabled) that you should honor
        # You can use this as a file path or folder and for both cases, you
        # need to create the file or folder
        if self._credential_cache is not None:
            bot.info("credential cache set to %s" %self._credential_cache)