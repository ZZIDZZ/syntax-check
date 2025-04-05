def event_notify(self, event):
        """
        Notify all subscribers of an event.

        event -- the event that occurred
        """
        if event.name not in self.available_events:
            return

        message = json.dumps({
            'messageType': 'event',
            'data': event.as_event_description(),
        })

        for subscriber in self.available_events[event.name]['subscribers']:
            try:
                subscriber.write_message(message)
            except tornado.websocket.WebSocketClosedError:
                pass