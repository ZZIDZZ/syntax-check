def _load_module(path):
    """Code to load create user module. Copied off django-browserid."""

    i = path.rfind(".")
    module, attr = path[:i], path[i + 1 :]

    try:
        mod = import_module(module)
    except ImportError:
        raise ImproperlyConfigured("Error importing CAN_LOGIN_AS function: {}".format(module))
    except ValueError:
        raise ImproperlyConfigured("Error importing CAN_LOGIN_AS" " function. Is CAN_LOGIN_AS a" " string?")

    try:
        can_login_as = getattr(mod, attr)
    except AttributeError:
        raise ImproperlyConfigured("Module {0} does not define a {1} " "function.".format(module, attr))
    return can_login_as