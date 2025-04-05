def get_placeholder(self, value=None, compiler=None, connection=None):
        """Tell postgres to encrypt this field using PGP."""
        return self.encrypt_sql.format(get_setting(connection, 'PUBLIC_PGP_KEY'))