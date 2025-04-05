def _handle_sigint(self, signum, frame):
        """Handler of SIGINT

        Does nothing if SIGINT is encountered once but raises a KeyboardInterrupt in case it
        is encountered twice.
        immediatly.

        """
        if self.hit:
            prompt = 'Exiting immediately!'
            raise KeyboardInterrupt(prompt)
        else:
            self.hit = True
            prompt = ('\nYou killed the process(es) via `SIGINT` (`CTRL+C`). '
                      'I am trying to exit '
                      'gracefully. Using `SIGINT` (`CTRL+C`) '
                      'again will cause an immediate exit.\n')
            sys.stderr.write(prompt)