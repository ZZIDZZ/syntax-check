def u2str(data):
    """Recursively converts unicode objects to UTF-8 encoded byte strings."""
    if isinstance(data, dict):
        return {u2str(k): u2str(v) for k, v in data.items()}
    elif isinstance(data, list):
        return [u2str(x) for x in data]
    elif isinstance(data, text_type):
        return data.encode('utf-8')
    else:
        return data