def cast(self, val: str):
        """converts string to type requested by `cast_as`"""
        try:
            return getattr(self, 'cast_as_{}'.format(
                self.cast_as.__name__.lower()))(val)
        except AttributeError:
            return self.cast_as(val)