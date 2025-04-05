def apply_to_with_tz(self, dttm, timezone):
        """We make sure that after truncating we use the correct timezone,
        even if we 'jump' over a daylight saving time switch.

        I.e. if we apply "@d" to `Sun Oct 30 04:30:00 CET 2016` (1477798200)
        we want to have `Sun Oct 30 00:00:00 CEST 2016` (1477778400)
        but not `Sun Oct 30 00:00:00 CET 2016` (1477782000)
        """
        result = self.apply_to(dttm)
        if self.unit in [DAYS, WEEKS, MONTHS, YEARS]:
            naive_dttm = datetime(result.year, result.month, result.day)
            result = timezone.localize(naive_dttm)
        return result