def _load_steps(self, raw_steps):
        """ load steps -> basically load all the datetime isoformats into datetimes """
        for step in raw_steps:
            if 'start' in step:
                step['start'] = parser.parse(step['start'])
            if 'stop' in step:
                step['stop'] = parser.parse(step['stop'])
        return raw_steps