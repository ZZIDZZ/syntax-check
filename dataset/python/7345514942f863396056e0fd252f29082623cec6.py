def serve(self, workers=None, **kwargs):
        """Serves the Flask application."""
        if self.app.debug:
            print(crayons.yellow('Booting Flask development server...'))
            self.app.run()

        else:
            print(crayons.yellow('Booting Gunicorn...'))

            # Start the web server.
            server = GunicornServer(
                self.app, workers=workers or number_of_gunicorn_workers(),
                worker_class='egg:meinheld#gunicorn_worker', **kwargs)
            server.run()