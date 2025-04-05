def setup_types(self):
        """
        The Message object has a circular reference on itself, thus we have to allow
        Type referencing by name. Here we lookup any Types referenced by name and
        replace with the real class.
        """
        def load(t):
            from TelegramBotAPI.types.type import Type
            if isinstance(t, str):
                return Type._type(t)
            assert issubclass(t, Type)
            return t
        self.types = [load(t) for t in self.types]