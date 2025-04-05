def run(self, root_allowed=False):
        """Start daemon mode

        :param bool root_allowed: Only used for ExecuteCmd
        :return: loop
        """
        self.root_allowed = root_allowed
        scan_devices(self.on_push, lambda d: d.src.lower() in self.devices, self.settings.get('interface'))