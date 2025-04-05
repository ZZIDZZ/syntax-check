def setLCD(self, password="00000000"):
        """ Serial call to set LCD using meter object bufer.

        Used with :func:`~ekmmeters.V4Meter.addLcdItem`.

        Args:
            password (str): Optional password

        Returns:
            bool: True on completion and ACK.
        """
        result = False
        self.setContext("setLCD")
        try:
            self.clearCmdMsg()

            if len(password) != 8:
                self.writeCmdMsg("Invalid password length.")
                self.setContext("")
                return result

            if not self.request():
                self.writeCmdMsg("Bad read CRC on setting")
            else:
                if not self.serialCmdPwdAuth(password):
                    self.writeCmdMsg("Password failure")
                else:
                    req_table = ""

                    fill_len = 40 - len(self.m_lcd_items)

                    for lcdid in self.m_lcd_items:
                        append_val = binascii.hexlify(str(lcdid).zfill(2))
                        req_table += append_val

                    for i in range(0, fill_len):
                        append_val = binascii.hexlify(str(0).zfill(2))
                        req_table += append_val

                    req_str = "015731023030443228" + req_table + "2903"
                    req_str += self.calc_crc16(req_str[2:].decode("hex"))
                    self.m_serial_port.write(req_str.decode("hex"))
                    if self.m_serial_port.getResponse(self.getContext()).encode("hex") == "06":
                        self.writeCmdMsg("Success: 06 returned.")
                        result = True
            self.serialPostEnd()
        except:
            ekm_log(traceback.format_exc(sys.exc_info()))

        self.setContext("")
        return result