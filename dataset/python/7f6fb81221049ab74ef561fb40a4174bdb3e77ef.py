def serve(self, server=None):
        """Serve app using wsgiref or provided server.

        Args:
        - server (callable): An callable
        """
        if server is None:
            from wsgiref.simple_server import make_server
            server = lambda app: make_server('', 8000, app).serve_forever()
            print('Listening on 0.0.0.0:8000')
        try:
            server(self)
        finally:
            server.socket.close()