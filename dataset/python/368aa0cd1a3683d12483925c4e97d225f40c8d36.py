def hotspots(self):
        '''
        Get lines sampled accross all threads, in order
        from most to least sampled.
        '''
        rooted_leaf_samples, _ = self.live_data_copy()
        line_samples = {}
        for _, counts in rooted_leaf_samples.items():
            for key, count in counts.items():
                line_samples.setdefault(key, 0)
                line_samples[key] += count
        return sorted(
            line_samples.items(), key=lambda v: v[1], reverse=True)