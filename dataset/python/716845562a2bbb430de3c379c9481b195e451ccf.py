def cli(ctx, apiurl, signature, username, password):
    """Command line interface for YOURLS.

    Configuration parameters can be passed as switches or stored in .yourls or
    ~/.yourls.

    If your YOURLS server requires authentication, please provide one of the
    following:

    \b
    • apiurl and signature
    • apiurl, username, and password

    Configuration file format:

    \b
    [yourls]
    apiurl = http://example.com/yourls-api.php
    signature = abcdefghij
    """
    if apiurl is None:
        raise click.UsageError("apiurl missing. See 'yourls --help'")

    auth_params = dict(signature=signature, username=username, password=password)

    try:
        ctx.obj = YOURLSClient(apiurl=apiurl, **auth_params)
    except TypeError:
        raise click.UsageError("authentication paremeters overspecified. "
                               "See 'yourls --help'")