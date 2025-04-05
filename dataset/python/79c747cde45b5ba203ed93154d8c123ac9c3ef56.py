def shift_annotations(self, time):
        """Shift all annotations in time. Annotations that are in the beginning
        and a left shift is applied can be squashed or discarded.

        :param int time: Time shift width, negative numbers make a left shift.
        :returns: Tuple of a list of squashed annotations and a list of removed
                  annotations in the format: ``(tiername, start, end, value)``.
        """
        total_re = []
        total_sq = []
        for name, tier in self.tiers.items():
            squashed = []
            for aid, (begin, end, value, _) in tier[0].items():
                if self.timeslots[end]+time <= 0:
                    squashed.append((name, aid))
                elif self.timeslots[begin]+time < 0:
                    total_sq.append((name, self.timeslots[begin],
                                     self.timeslots[end], value))
                    self.timeslots[begin] = 0
                else:
                    self.timeslots[begin] += time
                    self.timeslots[end] += time
            for name, aid in squashed:
                start, end, value, _ = self.tiers[name][0][aid]
                del(self.tiers[name][0][aid])
                del(self.annotations[aid])
                total_re.append(
                    (name, self.timeslots[start], self.timeslots[end], value))
        return total_sq, total_re