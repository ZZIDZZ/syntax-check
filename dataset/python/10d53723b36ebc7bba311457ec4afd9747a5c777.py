def _print_token_factory(col):
    """Internal helper to provide color names."""
    def _helper(msg):
        style = style_from_dict({
            Token.Color: col,
        })
        tokens = [
            (Token.Color, msg)
        ]
        print_tokens(tokens, style=style)

    def _helper_no_terminal(msg):
        # workaround if we have no terminal
        print(msg)
    if sys.stdout.isatty():
        return _helper
    else:
        return _helper_no_terminal