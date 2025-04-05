def rpc_spec_table(app):
    """Collects methods which are speced as RPC."""
    table = {}
    for attr, value in inspect.getmembers(app):
        rpc_spec = get_rpc_spec(value, default=None)
        if rpc_spec is None:
            continue
        table[rpc_spec.name] = (value, rpc_spec)
    return table