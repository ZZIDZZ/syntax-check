def dates_to_delete(dates,
                    years=0, months=0, weeks=0, days=0, firstweekday=SATURDAY,
                    now=None):
    """
    Return a set of date that should be deleted, out of ``dates``.

    See ``to_keep`` for a description of arguments.
    """
    dates = set(dates)
    return dates - dates_to_keep(dates,
                                 years=years, months=months,
                                 weeks=weeks, days=days,
                                 firstweekday=firstweekday, now=now)