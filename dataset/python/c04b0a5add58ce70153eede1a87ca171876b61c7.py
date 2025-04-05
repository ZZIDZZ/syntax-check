def parse(self, telegram_data):
        """
        Parse telegram from string to dict.

        The telegram str type makes python 2.x integration easier.

        :param str telegram_data: full telegram from start ('/') to checksum
            ('!ABCD') including line endings in between the telegram's lines
        :rtype: dict
        :returns: Shortened example:
            {
                ..
                r'\d-\d:96\.1\.1.+?\r\n': <CosemObject>,  # EQUIPMENT_IDENTIFIER
                r'\d-\d:1\.8\.1.+?\r\n': <CosemObject>,   # ELECTRICITY_USED_TARIFF_1
                r'\d-\d:24\.3\.0.+?\r\n.+?\r\n': <MBusObject>,  # GAS_METER_READING
                ..
            }
        :raises ParseError:
        :raises InvalidChecksumError:
        """

        if self.apply_checksum_validation \
                and self.telegram_specification['checksum_support']:
            self.validate_checksum(telegram_data)

        telegram = {}

        for signature, parser in self.telegram_specification['objects'].items():
            match = re.search(signature, telegram_data, re.DOTALL)

            # Some signatures are optional and may not be present,
            # so only parse lines that match
            if match:
                telegram[signature] = parser.parse(match.group(0))

        return telegram