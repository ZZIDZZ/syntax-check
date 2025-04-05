def forward(self, obj):
        """ Forward an object to clients.

        :param obj: The object to be forwarded
        :type obj: smsframework.data.IncomingMessage|smsframework.data.MessageStatus
        :raises Exception: if any of the clients failed
        """
        assert isinstance(obj, (IncomingMessage, MessageStatus)), 'Tried to forward an object of an unsupported type: {}'.format(obj)
        clients = self.choose_clients(obj)

        if Parallel:
            pll = Parallel(self._forward_object_to_client)
            for client in clients:
                pll(client, obj)
            results, errors = pll.join()
            if errors:
                raise errors[0]
        else:
            for client in clients:
                self._forward_object_to_client(client, obj)