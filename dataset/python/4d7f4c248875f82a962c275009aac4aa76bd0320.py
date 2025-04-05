def cycle(self):
        """
        Cycles through notifications with latest results from data feeds.
        """
        messages = self.poll_datafeeds()
        notifications = self.process_notifications(messages)

        self.draw_notifications(notifications)