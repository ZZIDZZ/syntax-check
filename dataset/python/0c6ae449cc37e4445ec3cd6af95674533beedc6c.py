def boot(self):
        """
        Boots a server for the app, if it isn't already booted.

        Returns:
            Server: This server.
        """

        if not self.responsive:
            # Remember the port so we can reuse it if we try to serve this same app again.
            type(self)._ports[self.port_key] = self.port

            init_func = capybara.servers[capybara.server_name]
            init_args = (self.middleware, self.port, self.host)

            self.server_thread = Thread(target=init_func, args=init_args)

            # Inform Python that it shouldn't wait for this thread to terminate before
            # exiting. (It will still be appropriately terminated when the process exits.)
            self.server_thread.daemon = True

            self.server_thread.start()

            # Make sure the server actually starts and becomes responsive.
            timer = Timer(60)
            while not self.responsive:
                if timer.expired:
                    raise RuntimeError("WSGI application timed out during boot")
                self.server_thread.join(0.1)

        return self