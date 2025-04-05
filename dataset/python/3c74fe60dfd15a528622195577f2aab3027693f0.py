def step(self, step_name):
        """Start a new step. returns a context manager which allows you to
        report an error"""

        @contextmanager
        def step_context(step_name):
            if self.event_receiver.current_case is not None:
                raise Exception('cannot open a step within a step')

            self.event_receiver.begin_case(step_name, self.now_seconds(), self.name)
            try:
                yield self.event_receiver
            except:
                etype, evalue, tb = sys.exc_info()
                self.event_receiver.error('%r' % [etype, evalue, tb])
                raise
            finally:
                self.event_receiver.end_case(step_name, self.now_seconds())

        return step_context(step_name)