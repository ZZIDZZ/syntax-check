def parse(self, keydata=None):
        """Validates SSH public key.

        Throws exception for invalid keys. Otherwise returns None.

        Populates key_type, bits and bits fields.

        For rsa keys, see field "rsa" for raw public key data.
        For dsa keys, see field "dsa".
        For ecdsa keys, see field "ecdsa"."""
        if keydata is None:
            if self.keydata is None:
                raise ValueError("Key data must be supplied either in constructor or to parse()")
            keydata = self.keydata
        else:
            self.reset()
            self.keydata = keydata

        if keydata.startswith("---- BEGIN SSH2 PUBLIC KEY ----"):
            # SSH2 key format
            key_type = None  # There is no redundant key-type field - skip comparing plain-text and encoded data.
            pubkey_content = "".join([line for line in keydata.split("\n") if ":" not in line and "----" not in line])
        else:
            key_parts = self._split_key(keydata)
            key_type = key_parts[0]
            pubkey_content = key_parts[1]

        self._decoded_key = self.decode_key(pubkey_content)

        # Check key type
        current_position, unpacked_key_type = self._unpack_by_int(self._decoded_key, 0)
        if key_type is not None and key_type != unpacked_key_type.decode():
            raise InvalidTypeError("Keytype mismatch: %s != %s" % (key_type, unpacked_key_type))

        self.key_type = unpacked_key_type

        key_data_length = self._process_key(self._decoded_key[current_position:])
        current_position = current_position + key_data_length

        if current_position != len(self._decoded_key):
            raise MalformedDataError("Leftover data: %s bytes" % (len(self._decoded_key) - current_position))

        if self.disallow_options and self.options:
            raise InvalidOptionsError("Options are disallowed.")