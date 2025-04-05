def serve(self, app_docopt=DEFAULT_DOC, description=''):
        ''' Configure from cli and run the server '''

        exit_status = 0
        if isinstance(app_docopt, str):
            args = docopt(app_docopt, version=description)
        elif isinstance(app_docopt, dict):
            args = app_docopt
        else:
            raise ValueError('unknown configuration object ({})'
                             .format(type(app_docopt)))
        log_level = args.get('--log', 'debug')
        is_debug = args.get('--debug', False)
        # TODO More serious default
        log_output = 'stdout' if is_debug else 'apy.log'
        safe_bind = args.get('--bind', '127.0.0.1')
        safe_port = int(args.get('--port', 5000))
        log_setup = dna.logging.setup(level=log_level, output=log_output)

        with log_setup.applicationbound():
            try:
                log.info('server ready',
                         version=description,
                         log=log_level,
                         debug=is_debug,
                         bind='{}:{}'.format(safe_bind, safe_port))

                self.app.run(host=safe_bind,
                             port=safe_port,
                             debug=is_debug)

            except Exception as error:
                if is_debug:
                    raise
                log.error('{}: {}'.format(type(error).__name__, str(error)))
                exit_status = 1

            finally:
                log.info('session ended with status {}'.format(exit_status))

        return exit_status