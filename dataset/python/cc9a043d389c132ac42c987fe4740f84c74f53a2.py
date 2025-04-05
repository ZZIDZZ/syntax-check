def parse(self, config_file=None, specs=None, default_file=None):
        """Read a config_file, check the validity with a JSON Schema as specs
        and get default values from default_file if asked.

        All parameters are optionnal.

        If there is no config_file defined, read the venv base
        dir and try to get config/app.yml.

        If no specs, don't validate anything.

        If no default_file, don't merge with default values."""

        self._config_exists(config_file)
        self._specs_exists(specs)

        self.loaded_config = anyconfig.load(self.config_file, ac_parser='yaml')

        if default_file is not None:
            self._merge_default(default_file)

        if self.specs is None:
            return self.loaded_config

        self._validate()

        return self.loaded_config