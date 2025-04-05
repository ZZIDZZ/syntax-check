def parse_env_var(value):
    """
    Split a env var text like

    ENV_VAR_NAME=env_var_value

    into a tuple ('ENV_VAR_NAME', 'env_var_value')
    """
    k, _, v = value.partition('=')

    # Remove any leading and trailing spaces in key, value
    k, v = k.strip(), v.strip().encode('unicode-escape').decode('ascii')

    if v and v[0] == v[-1] in ['"', "'"]:
        v = __escape_decoder(v[1:-1])[0]
    return k, v