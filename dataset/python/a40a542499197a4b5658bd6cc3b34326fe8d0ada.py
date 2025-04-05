def main():
    """
    Program main.
    """

    options = parse_options()
    output, code = create_output(get_status(options), options)
    sys.stdout.write(output)
    sys.exit(code)