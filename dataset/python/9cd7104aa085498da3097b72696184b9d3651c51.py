def concatenate(arrays, axis=0):
        """
        Join a sequence of arrays together.

        Parameters
        ----------
        arrays : tuple
            A sequence of array-like e.g. (a1, a2, ...)

        axis : int, optional, default=0
            The axis along which the arrays will be joined.

        Returns
        -------
        BoltArrayLocal
        """
        if not isinstance(arrays, tuple):
            raise ValueError("data type not understood")
        arrays = tuple([asarray(a) for a in arrays])
        from numpy import concatenate
        return BoltArrayLocal(concatenate(arrays, axis))