def rollup(self):
        """Roll up stats and log them."""
        now = time.time()
        if now < self.next_rollup:
            return

        self.next_rollup = now + self.flush_interval

        for key, values in sorted(self.incr_stats.items()):
            self.logger.info(
                '%s INCR %s: count:%d|rate:%d/%d',
                self.leader,
                key,
                len(values),
                sum(values),
                self.flush_interval
            )
            self.incr_stats[key] = []

        for key, values in sorted(self.gauge_stats.items()):
            if values:
                self.logger.info(
                    '%s GAUGE %s: count:%d|current:%s|min:%s|max:%s',
                    self.leader,
                    key,
                    len(values),
                    values[-1],
                    min(values),
                    max(values),
                )
            else:
                self.logger.info('%s (gauge) %s: no data', self.leader, key)

            self.gauge_stats[key] = []

        for key, values in sorted(self.histogram_stats.items()):
            if values:
                self.logger.info(
                    (
                        '%s HISTOGRAM %s: '
                        'count:%d|min:%.2f|avg:%.2f|median:%.2f|ninety-five:%.2f|max:%.2f'
                    ),
                    self.leader,
                    key,
                    len(values),
                    min(values),
                    statistics.mean(values),
                    statistics.median(values),
                    values[int(len(values) * 95 / 100)],
                    max(values)
                )
            else:
                self.logger.info('%s (histogram) %s: no data', self.leader, key)

            self.histogram_stats[key] = []