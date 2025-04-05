def _regexp(filename):
    """Get a list of patterns from a file and make a regular expression."""
    lines = _get_resource_content(filename).decode('utf-8').splitlines()
    return re.compile('|'.join(lines))