def _buffered_send_metric(self, metric_str):
        """Add a metric to the buffer."""

        self.batch_count += 1

        self.batch_buffer += metric_str

        # NOTE(romcheg): Send metrics if the number of metrics in the buffer
        #                has reached the threshold for sending.
        if self.batch_count >= self.batch_size:
            self._send()