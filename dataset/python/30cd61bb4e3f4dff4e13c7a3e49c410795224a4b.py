def format_duration(seconds):
    """Formats a number of seconds using the best units."""
    units, divider = get_time_units_and_multiplier(seconds)
    seconds *= divider
    return "%.3f %s" % (seconds, units)