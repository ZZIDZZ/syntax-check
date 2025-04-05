def set_volume_level(self, volume):
        """Set volume level."""
        if self._volume_level is not None:
            if volume > self._volume_level:
                num = int(self._max_volume * (volume - self._volume_level))
                self._volume_level = volume
                self._device.vol_up(num=num)
            elif volume < self._volume_level:
                num = int(self._max_volume * (self._volume_level - volume))
                self._volume_level = volume
                self._device.vol_down(num=num)