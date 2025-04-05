def run(func, options, args=(), kwargs={}, host='localhost', port=8000):  # pylint: disable=dangerous-default-value
    """Runs profilers on a function.

    Args:
        func: A Python function.
        options: A string with profilers configuration (i.e. 'cmh').
        args: func non-keyword arguments.
        kwargs: func keyword arguments.
        host: Host name to send collected data.
        port: Port number to send collected data.

    Returns:
        A result of func execution.
    """
    run_stats = run_profilers((func, args, kwargs), options)

    result = None
    for prof in run_stats:
        if not result:
            result = run_stats[prof]['result']
        del run_stats[prof]['result']  # Don't send result to remote host

    post_data = gzip.compress(
        json.dumps(run_stats).encode('utf-8'))
    urllib.request.urlopen('http://%s:%s' % (host, port), post_data)
    return result