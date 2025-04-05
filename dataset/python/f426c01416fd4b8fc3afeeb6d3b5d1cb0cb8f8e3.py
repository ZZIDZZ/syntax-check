def clear_derived(self):
        """ Reset the value of all Derived properties to None

        This is called by setp (and by extension __setattr__)
        """
        for p in self.params.values():
            if isinstance(p, Derived):
                p.clear_value()