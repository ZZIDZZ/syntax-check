def get_model_class(settings_entry_name):
    """Returns a certain sitetree model as defined in the project settings.

    :param str|unicode settings_entry_name:
    :rtype: TreeItemBase|TreeBase
    """
    app_name, model_name = get_app_n_model(settings_entry_name)

    try:
        model = apps_get_model(app_name, model_name)
    except (LookupError, ValueError):
        model = None

    if model is None:
        raise ImproperlyConfigured(
            '`SITETREE_%s` refers to model `%s` that has not been installed.' % (settings_entry_name, model_name))

    return model