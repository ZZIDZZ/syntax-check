def from_yaml(cls, defaults, **kwargs):
        """Creates a new instance of a rule by merging two dictionaries.

        This allows for independant configuration files to be merged
        into the defaults."""
        # TODO: I hate myself for this. Fix it later mmkay?
        if "token" not in defaults:
            kwargs["token"] = None

        defaults = copy.deepcopy(defaults)
        return cls(
            defaults=defaults,
            token=kwargs.pop("token"),
            directory=kwargs.pop("directory"),
            **kwargs
        )