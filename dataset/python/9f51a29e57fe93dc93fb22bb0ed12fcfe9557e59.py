def on_renewing(self):
        """Action on renewing on RENEWING state.

        Not recording lease, but restarting timers.

        """
        self.client.lease.sanitize_net_values()
        self.client.lease.set_times(self.time_sent_request)
        self.set_timers()