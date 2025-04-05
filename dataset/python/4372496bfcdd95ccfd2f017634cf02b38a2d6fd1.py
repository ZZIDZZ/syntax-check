def fetch_data(self):
        """Get the latest data from Enedis."""

        for t in [HOURLY, DAILY, MONTHLY, YEARLY]:
            self._data[t] = self.get_data_per_period(t)