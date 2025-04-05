def _index(self, name):
        '''Returns index transforms for ``name``.

        :type name: unicode
        :rtype: ``{ create |--> function, transform |--> function }``
        '''
        name = name.decode('utf-8')
        try:
            return self._indexes[name]
        except KeyError:
            raise KeyError('Index "%s" has not been registered with '
                           'this FC store.' % name)