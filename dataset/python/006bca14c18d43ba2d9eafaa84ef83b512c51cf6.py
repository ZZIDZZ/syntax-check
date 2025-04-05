def spisend(self, bytes_to_send):
        """Sends bytes via the SPI bus.

        :param bytes_to_send: The bytes to send on the SPI device.
        :type bytes_to_send: bytes
        :returns: bytes -- returned bytes from SPI device
        :raises: InitError
        """
        # make some buffer space to store reading/writing
        wbuffer = ctypes.create_string_buffer(bytes_to_send,
                                              len(bytes_to_send))
        rbuffer = ctypes.create_string_buffer(len(bytes_to_send))

        # create the spi transfer struct
        transfer = spi_ioc_transfer(
            tx_buf=ctypes.addressof(wbuffer),
            rx_buf=ctypes.addressof(rbuffer),
            len=ctypes.sizeof(wbuffer),
            speed_hz=ctypes.c_uint32(self.speed_hz)
        )

        if self.spi_callback is not None:
            self.spi_callback(bytes_to_send)
        # send the spi command
        ioctl(self.fd, SPI_IOC_MESSAGE(1), transfer)
        return ctypes.string_at(rbuffer, ctypes.sizeof(rbuffer))