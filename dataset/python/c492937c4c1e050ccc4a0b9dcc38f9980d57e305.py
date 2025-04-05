def main(ctx, log_level, keeper_hostname, username, password):
    """ltd is a command-line client for LSST the Docs.

    Use ltd to upload new site builds, and to work with the LTD Keeper API.
    """
    ch = logging.StreamHandler()
    formatter = logging.Formatter(
        '%(asctime)s %(levelname)8s %(name)s | %(message)s')
    ch.setFormatter(formatter)

    logger = logging.getLogger('ltdconveyor')
    logger.addHandler(ch)
    logger.setLevel(log_level.upper())

    # Subcommands should use the click.pass_obj decorator to get this
    # ctx.obj object as the first argument.
    ctx.obj = {
        'keeper_hostname': keeper_hostname,
        'username': username,
        'password': password,
        'token': None
    }