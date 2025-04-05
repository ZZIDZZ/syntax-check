def log_time(self):
        """Return True if it's time to log"""
        if self.hot_loop and self.time_delta >= self.log_interval:
            return True
        return False