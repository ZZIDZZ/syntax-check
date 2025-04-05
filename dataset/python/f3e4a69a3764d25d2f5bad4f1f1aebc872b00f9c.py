def get_model(name: str) -> type:
    """Returns a registered class object with the name given in the string."""
    if name not in _REGISTRY:
        if ':' not in name:
            raise ConfigError("Model {} is not registered.".format(name))
        return cls_from_str(name)
    return cls_from_str(_REGISTRY[name])