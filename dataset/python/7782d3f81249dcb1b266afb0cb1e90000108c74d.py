def name(self):
        """ Return a basic meaningful name based on device type """
        if (
            self.device_type and
            self.device_type.code in (DeviceType.MOBILE, DeviceType.TABLET)
        ):
            return self.device
        else:
            return self.browser