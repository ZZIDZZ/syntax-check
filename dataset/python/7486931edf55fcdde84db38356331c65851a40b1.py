def _set_addr(self, addr):
        """private helper method"""
        if self._addr != addr:
            ioctl(self._fd, SMBUS.I2C_SLAVE, addr)
            self._addr = addr