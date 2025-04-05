def check_for_cancelled_events(self, d):
        """Check if any events are cancelled on the given date 'd'."""
        for event in self.events:
            for cn in event.cancellations.all():
                if cn.date == d:
                    event.title += ' (CANCELLED)'