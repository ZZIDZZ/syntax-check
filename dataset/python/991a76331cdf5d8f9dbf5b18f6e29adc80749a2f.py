def unparse_headers(hdrs):
    """Parse a dictionary of headers to a string.

    Args:
        hdrs: A dictionary of headers.

    Returns:
        The headers as a string that can be used in an NNTP POST.
    """
    return "".join([unparse_header(n, v) for n, v in hdrs.items()]) + "\r\n"