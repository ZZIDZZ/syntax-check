def add(self, nick):
        """\
        Indicate that the worker with given nick is performing this task
        """
        self.data[nick] = ''
        self.workers.add(nick)