def get_abook(self, name):
        """Get one of the backing abdress books by its name,

        :param name: the name of the address book to get
        :type name: str
        :returns: the matching address book or None
        :rtype: AddressBook or NoneType

        """
        for abook in self._abooks:
            if abook.name == name:
                return abook