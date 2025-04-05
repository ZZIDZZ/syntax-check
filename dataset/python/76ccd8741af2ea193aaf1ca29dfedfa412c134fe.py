def findObjects(self, template=()):
        """
        find the objects matching the template pattern

        :param template: list of attributes tuples (attribute,value).
          The default value is () and all the objects are returned
        :type template: list
        :return: a list of object ids
        :rtype: list
        """
        t = self._template2ckattrlist(template)

        # we search for 10 objects by default. speed/memory tradeoff
        result = PyKCS11.LowLevel.ckobjlist(10)

        rv = self.lib.C_FindObjectsInit(self.session, t)
        if rv != CKR_OK:
            raise PyKCS11Error(rv)

        res = []
        while True:
            rv = self.lib.C_FindObjects(self.session, result)
            if rv != CKR_OK:
                raise PyKCS11Error(rv)
            for x in result:
                # make a copy of the handle: the original value get
                # corrupted (!!)
                a = CK_OBJECT_HANDLE(self)
                a.assign(x.value())
                res.append(a)
            if len(result) == 0:
                break

        rv = self.lib.C_FindObjectsFinal(self.session)
        if rv != CKR_OK:
            raise PyKCS11Error(rv)
        return res