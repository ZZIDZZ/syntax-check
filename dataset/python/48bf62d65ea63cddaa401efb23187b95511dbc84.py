def pub(self, topic, msg, callback=None):
        """
        publish a message to nsq

        :param topic: nsq topic
        :param msg: message body (bytes)
        :param callback: function which takes (conn, data) (data may be nsq.Error)
        """
        self._pub('pub', topic, msg, callback=callback)