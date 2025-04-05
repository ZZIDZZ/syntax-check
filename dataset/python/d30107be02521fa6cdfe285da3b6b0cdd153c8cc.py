def clear(self):
        """
        Completely resets the database. This means that all information in
        the local cache and on disc will be erased.
        """
        if not os.path.isdir(self.fdir):
            os.makedirs(self.fdir, exist_ok=True)
            return

        for f in os.listdir(self.fdir):
            del self[f]