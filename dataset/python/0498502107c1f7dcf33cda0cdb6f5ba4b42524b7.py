def transform(self, fn, column=None, dtype=None):
        """Execute a transformation on a column or columns. Returns the modified
        DictRDD.

        Parameters
        ----------
        f : function
            The function to execute on the columns.
        column : {str, list or None}
            The column(s) to transform. If None is specified the method is
            equivalent to map.
        column : {str, list or None}
            The dtype of the column(s) to transform.

        Returns
        -------
        result : DictRDD
            DictRDD with transformed column(s).

        TODO: optimize
        """
        dtypes = self.dtype
        if column is None:
            indices = list(range(len(self.columns)))
        else:
            if not type(column) in (list, tuple):
                column = [column]
            indices = [self.columns.index(c) for c in column]

        if dtype is not None:
            if not type(dtype) in (list, tuple):
                dtype = [dtype]
            dtypes = [dtype[indices.index(i)] if i in indices else t
                      for i, t in enumerate(self.dtype)]

        def mapper(values):
            result = fn(*[values[i] for i in indices])

            if len(indices) == 1:
                result = (result,)
            elif not isinstance(result, (tuple, list)):
                raise ValueError("Transformer function must return an"
                                 " iterable!")
            elif len(result) != len(indices):
                raise ValueError("Transformer result's length must be"
                                 " equal to the given columns length!")

            return tuple(result[indices.index(i)] if i in indices else v
                         for i, v in enumerate(values))

        return DictRDD(self._rdd.map(mapper),
                       columns=self.columns, dtype=dtypes,
                       bsize=self.bsize, noblock=True)