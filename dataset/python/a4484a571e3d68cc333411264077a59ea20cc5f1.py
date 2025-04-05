def _get_current_object(self):
        """Get current object.
        This is useful if you want the real
        object behind the proxy at a time for performance reasons or because
        you want to pass the object into a different context.
        """
        loc = object.__getattribute__(self, '_Proxy__local')
        if not hasattr(loc, '__release_local__'):
            return loc(*self.__args, **self.__kwargs)
        try:  # pragma: no cover
            # not sure what this is about
            return getattr(loc, self.__name__)
        except AttributeError:  # pragma: no cover
            raise RuntimeError('no object bound to {0.__name__}'.format(self))