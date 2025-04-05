def url_with_auth(regex, view, kwargs=None, name=None, prefix=''):
    """
    if view is string based, must be a full path
    """
    from djapiauth.auth import api_auth
    if isinstance(view, six.string_types):  # view is a string, must be full path
        return url(regex, api_auth(import_by_path(prefix + "." + view if prefix else view)))
    elif isinstance(view, (list, tuple)):  # include
        return url(regex, view, name, prefix, **kwargs)
    else:  # view is an object
        return url(regex, api_auth(view))