def from_user_creds(cls, username, password, url=URL_BASE):
        """
        Obtain a short-lived token using a username and password, and use that
        token to create an auth object.
        """
        session = requests.session()
        token_resp = session.post(url.rstrip('/') + '/user/login/',
                                  data={'username': username,
                                        'password': password})
        if token_resp.status_code != 200:
            error = token_resp.text
            try:
                error = json.loads(error)['error']
            except (KeyError, ValueError):
                pass
            raise LuminosoLoginError(error)

        return cls(token_resp.json()['result']['token'])