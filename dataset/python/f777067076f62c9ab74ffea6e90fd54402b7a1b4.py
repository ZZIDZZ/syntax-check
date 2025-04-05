def mutate_object_decorate(self, func):
        """
        Mutate a generic object based on type
        """
        def mutate():
            obj = func()
            return self.Mutators.get_mutator(obj, type(obj))
        return mutate