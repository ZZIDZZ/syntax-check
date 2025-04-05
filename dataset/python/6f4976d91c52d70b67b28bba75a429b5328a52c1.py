def write_i2c_block_data(self, addr, cmd, vals):
        """Write a buffer of data to the specified cmd register of the device.
        """
        assert self._device is not None, 'Bus must be opened before operations are made against it!'
        # Construct a string of data to send, including room for the command register.
        data = bytearray(len(vals)+1)
        data[0] = cmd & 0xFF  # Command register at the start.
        data[1:] = vals[0:]   # Copy in the block data (ugly but necessary to ensure
                              # the entire write happens in one transaction).
        # Send the data to the device.
        self._select_device(addr)
        self._device.write(data)