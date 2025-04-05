def done(self, message: str=None):
        """
        Signal that this task is done.
        This is completely optional and will just call .update with the remaining work.
        """
        if message is None:
            message = "{self.name} done".format(**locals()) if self.name else "Done"
        self.update(units=self.total - self.worked, message=message)