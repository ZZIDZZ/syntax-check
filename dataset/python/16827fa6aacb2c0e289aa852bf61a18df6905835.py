def cancel_order(self, multi=False, **order_identifiers):
        """Cancel one or multiple orders via Websocket.

        :param multi: bool, whether order_settings contains settings for one, or
                      multiples orders
        :param order_identifiers: Identifiers for the order(s) you with to cancel
        :return:
        """
        if multi:
            self._send_auth_command('oc_multi', order_identifiers)
        else:
            self._send_auth_command('oc', order_identifiers)