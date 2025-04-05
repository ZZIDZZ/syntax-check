def init_app(self, app):
        """
        Used to initialize redis with app object
        """

        app.config.setdefault('REDIS_URLS', {
            'main': 'redis://localhost:6379/0',
            'admin': 'redis://localhost:6379/1',
        })

        app.before_request(self.before_request)

        self.app = app