def build_parser():
    """Build the parser that will have all available commands and options."""
    description = (
        'HTTPony (pronounced aych-tee-tee-pony) is a simple HTTP '
        'server that pretty prints HTTP requests to a terminal. It '
        'is a useful aide for developing clients that send HTTP '
        'requests. HTTPony acts as a sink for a client so that a '
        'developer can understand what the client is sending.')
    parser = argparse.ArgumentParser(description=description)
    parser.add_argument(
        '-l', '--listen', help='set the IP address or hostname',
        default='localhost')
    parser.add_argument(
        '-p', '--port', help='set the port', default=8000, type=int)

    return parser