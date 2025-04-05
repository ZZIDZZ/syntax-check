def main():
    """
    Processing notification call main function.
    """

    # getting info for creating event
    options = parse_options()
    config = parse_config(options)
    credentials = get_google_credentials(options, config)

    if not options.get_google_credentials:
        create_event(options, config, credentials)