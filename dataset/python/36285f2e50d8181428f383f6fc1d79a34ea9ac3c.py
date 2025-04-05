def connect(cls, settings):
        """ Call that method in the pyramid configuration phase.
        """
        server = serializer('json').loads(settings['kvs.perlsess'])
        server.setdefault('key_prefix', 'perlsess::')
        server.setdefault('codec', 'storable')
        cls.cookie_name = server.pop('cookie_name', 'session_id')
        cls.client = KVS(**server)