def remote_app(self, name, version=None, **kwargs):
        """Creates and adds new remote application.

        :param name: the remote application's name.
        :param version: '1' or '2', the version code of OAuth protocol.
        :param kwargs: the attributes of remote application.
        """
        if version is None:
            if 'request_token_url' in kwargs:
                version = '1'
            else:
                version = '2'
        if version == '1':
            remote_app = OAuth1Application(name, clients=cached_clients)
        elif version == '2':
            remote_app = OAuth2Application(name, clients=cached_clients)
        else:
            raise ValueError('unkonwn version %r' % version)
        return self.add_remote_app(remote_app, **kwargs)