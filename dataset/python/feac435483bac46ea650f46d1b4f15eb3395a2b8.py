def update(self, allow_partial=True, force=False, **kwargs):
        """Updates record and returns True if record is complete after update, else False."""
        if kwargs:
            self.__init__(partial=allow_partial, force=force, **kwargs)
            return not self._partial

        if not force and CACHE.get(hash(self)):
            cached = CACHE[hash(self)]
            for field in self._SIMPLE_FIELDS | self._COMPLEX_FIELDS:
                v = getattr(cached, field)
                setattr(self, field, v)
            self._partial = False
            logging.info(f'Loading {str(self)} from cache')
            return True
        resp_dict = element_lookup_by_id(self.type, self.id)
        self.__init__(partial=False, **resp_dict)
        return True