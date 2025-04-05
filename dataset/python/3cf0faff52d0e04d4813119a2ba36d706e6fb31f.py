def destroy_connection(self, connection):
        """
        Destroys a connection. Removes the connection from the appcontext, and
        unbinds it.

        Args:
            connection (ldap3.Connection):  The connnection to destroy
        """

        log.debug("Destroying connection at <{0}>".format(hex(id(connection))))
        self._decontextualise_connection(connection)
        connection.unbind()