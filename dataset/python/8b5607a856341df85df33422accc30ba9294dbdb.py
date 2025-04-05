def get(cls, ids):
        '''
        Will fetch one or more entities of this type from the session or
        Redis.

        Used like::

            MyModel.get(5)
            MyModel.get([1, 6, 2, 4])

        Passing a list or a tuple will return multiple entities, in the same
        order that the ids were passed.
        '''
        conn = _connect(cls)
        # prepare the ids
        single = not isinstance(ids, (list, tuple, set, frozenset))
        if single:
            ids = [ids]
        pks = ['%s:%s'%(cls._namespace, id) for id in map(int, ids)]
        # get from the session, if possible
        out = list(map(session.get, pks))
        # if we couldn't get an instance from the session, load from Redis
        if None in out:
            pipe = conn.pipeline(True)
            idxs = []
            # Fetch missing data
            for i, data in enumerate(out):
                if data is None:
                    idxs.append(i)
                    pipe.hgetall(pks[i])
            # Update output list
            for i, data in zip(idxs, pipe.execute()):
                if data:
                    if six.PY3:
                        data = dict((k.decode(), v.decode()) for k, v in data.items())
                    out[i] = cls(_loading=True, **data)
            # Get rid of missing models
            out = [x for x in out if x]
        if single:
            return out[0] if out else None
        return out