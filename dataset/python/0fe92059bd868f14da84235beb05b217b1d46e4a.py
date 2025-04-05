def config_value(key, app=None, default=None, prefix='hive_'):
    """Get a Flask-Security configuration value.

    :param key: The configuration key without the prefix `SECURITY_`
    :param app: An optional specific application to inspect. Defaults to
                Flask's `current_app`
    :param default: An optional default value if the value is not set
    """
    app = app or current_app
    return get_config(app, prefix=prefix).get(key.upper(), default)