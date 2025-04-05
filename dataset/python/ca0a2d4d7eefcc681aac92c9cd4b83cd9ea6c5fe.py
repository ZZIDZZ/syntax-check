def refresh(self, force=False, _retry=0):
		"""
		Check if the token is still valid and requests a new if it is not
		valid anymore

		Call this method before a call to praw
		if there might have passed more than one hour

		force: if true, a new token will be retrieved no matter what
		"""
		if _retry >= 5:
			raise ConnectionAbortedError('Reddit is not accessible right now, cannot refresh OAuth2 tokens.')
		self._check_token_present()

		# We check whether another instance already refreshed the token
		if time.time() > self._get_value(CONFIGKEY_VALID_UNTIL, float, exception_default=0) - REFRESH_MARGIN:
			self.config.read(self.configfile)

			if time.time() < self._get_value(CONFIGKEY_VALID_UNTIL, float, exception_default=0) - REFRESH_MARGIN:
				self._log("Found new token")
				self.set_access_credentials()

		if force or time.time() > self._get_value(CONFIGKEY_VALID_UNTIL, float, exception_default=0) - REFRESH_MARGIN:
			self._log("Refresh Token")
			try:
				new_token = self.r.refresh_access_information(self._get_value(CONFIGKEY_REFRESH_TOKEN))
				self._change_value(CONFIGKEY_TOKEN, new_token["access_token"])
				self._change_value(CONFIGKEY_VALID_UNTIL, time.time() + TOKEN_VALID_DURATION)
				self.set_access_credentials()
			except (praw.errors.OAuthInvalidToken, praw.errors.HTTPException) as e:
				# todo check e status code
				# self._log('Retrying in 5s.')
				# time.sleep(5)
				# self.refresh(_retry=_retry + 1)

				self._log("Request new Token (REF)")
				self._get_new_access_information()