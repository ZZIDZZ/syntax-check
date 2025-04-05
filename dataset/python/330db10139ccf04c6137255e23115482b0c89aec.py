def human_bytes(value):
    """
    Convert a byte value into a human-readable format.
    """
    value = float(value)
    if value >= 1073741824:
        gigabytes = value / 1073741824
        size = '%.2f GB' % gigabytes
    elif value >= 1048576:
        megabytes = value / 1048576
        size = '%.2f MB' % megabytes
    elif value >= 1024:
        kilobytes = value / 1024
        size = '%.2f KB' % kilobytes
    else:
        size = '%.2f B' % value
    return size