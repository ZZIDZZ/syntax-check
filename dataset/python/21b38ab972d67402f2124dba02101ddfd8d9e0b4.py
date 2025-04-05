def _get_key(self):
        """Get key using token from gateway"""
        init_vector = bytes(bytearray.fromhex('17996d093d28ddb3ba695a2e6f58562e'))
        encryptor = Cipher(algorithms.AES(self.key.encode()), modes.CBC(init_vector),
                           backend=default_backend()).encryptor()
        ciphertext = encryptor.update(self.token.encode()) + encryptor.finalize()
        if isinstance(ciphertext, str):  # For Python 2 compatibility
            return ''.join('{:02x}'.format(ord(x)) for x in ciphertext)
        return ''.join('{:02x}'.format(x) for x in ciphertext)