def _unreg_event(self, event_list, event):
        """ Tries to remove a registered event without triggering it """
        try:
            self.log.debug("Removing event {0}({1},{2})".format(event['function'].__name__, event['args'], event['kwargs']))
        except AttributeError:
            self.log.debug("Removing event {0}".format(str(event)))

        try:
            event_list.remove(event)
        except ValueError:
            try:
                self.log.warn("Unable to remove event {0}({1},{2}) , not found in list: {3}".format(event['function'].__name__, event['args'], event['kwargs'], event_list))
            except AttributeError:
                self.log.debug("Unable to remove event {0}".format(str(event)))
            raise KeyError('Unable to unregister the specified event from the signals specified')