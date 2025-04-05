def get_instances(self):
        """Mostly used for debugging"""
        return ["<%s prefix:%s (uid:%s)>" % (self.__class__.__name__,
                                             i.prefix, self.uid)
                for i in self.instances]