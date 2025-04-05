def as_future(self, query):
        """Wrap a `sqlalchemy.orm.query.Query` object into a
        `concurrent.futures.Future` so that it can be yielded.

        Parameters
        ----------
        query : sqlalchemy.orm.query.Query
            SQLAlchemy query object to execute

        Returns
        -------
            tornado.concurrent.Future
                A `Future` object wrapping the given query so that tornado can
                await/yield on it
        """
        # concurrent.futures.Future is not compatible with the "new style"
        # asyncio Future, and awaiting on such "old-style" futures does not
        # work.
        #
        # tornado includes a `run_in_executor` function to help with this
        # problem, but it's only included in version 5+. Hence, we copy a
        # little bit of code here to handle this incompatibility.

        if not self._pool:
            self._pool = ThreadPoolExecutor(max_workers=self._max_workers)

        old_future = self._pool.submit(query)
        new_future = Future()

        IOLoop.current().add_future(
            old_future, lambda f: chain_future(f, new_future)
        )

        return new_future