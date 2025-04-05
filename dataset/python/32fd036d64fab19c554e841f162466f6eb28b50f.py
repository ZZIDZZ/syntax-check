def dereference(self, callback=None, args=None, kwargs=None):
        """
        This method should only be called while the reference is locked.

        Decrements the reference count for the resource. If this process holds
        the only reference at the time we finish dereferencing it; True is
        returned. Operating on the resource after it has been dereferenced is
        undefined behavior.

        Dereference queries the value stored in the backend, if any, iff (if
        and only if) this instance is the last reference to that resource. e.g.
        self.count() == 0

        :param function callback: A function to execute iff it's determined
            this process holds the only reference to the resource. When there
            is a failure communicating with the backend in the cleanup step the
            callback function will be called an additional time for that
            failure and each subsequent one thereafter. Ensure your callback
            handles this properly.
        :param tuple args: Positional arguments to pass your callback.
        :param dict kwargs: keyword arguments to pass your callback.

        :returns: Whether or not there are no more references among all
            processes. True if this was the last reference. False otherwise.
        :rtype: bool
        """
        if args is None:
            args = tuple()
        if kwargs is None:
            kwargs = {}

        client = self.conn.client

        should_execute = False
        if self.force_expiry:
            should_execute = True

        if not should_execute:
            self.nodelist.remove_node(self.conn.id)
            self.nodelist.remove_expired_nodes()

            updated_refcount = client.incr(self.refcount_key, -1)
            should_execute = (updated_refcount <= 0)  # When we force expiry this will be -1

        try:
            if callable(callback) and should_execute:
                callback(*args, **kwargs)
        finally:
            if should_execute:
                client.delete(self.resource_key,
                              self.nodelist.nodelist_key,
                              self.times_modified_key,
                              self.refcount_key)

            self.conn.remove_from_registry(self.resource_key)
        return should_execute