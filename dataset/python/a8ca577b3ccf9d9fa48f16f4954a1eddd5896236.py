def store(self, usage=None, mech=None, overwrite=False, default=False, cred_store=None):
        """
        Stores this credential into a 'credential store'. It can either store this credential in
        the default credential store, or into a specific credential store specified by a set of
        mechanism-specific key-value pairs. The former method of operation requires that the
        underlying GSSAPI implementation supports the ``gss_store_cred`` C function, the latter
        method requires support for the ``gss_store_cred_into`` C function.

        :param usage: Optional parameter specifying whether to store the initiator, acceptor, or
            both usages of this credential. Defaults to the value of this credential's
            :attr:`usage` property.
        :type usage: One of :data:`~gssapi.C_INITIATE`, :data:`~gssapi.C_ACCEPT` or
            :data:`~gssapi.C_BOTH`
        :param mech: Optional parameter specifying a single mechanism to store the credential
            element for. If not supplied, all mechanisms' elements in this credential will be
            stored.
        :type mech: :class:`~gssapi.oids.OID`
        :param overwrite: If True, indicates that any credential for the same principal in the
            credential store should be overwritten with this credential.
        :type overwrite: bool
        :param default: If True, this credential should be made available as the default
            credential when stored, for acquisition when no `desired_name` parameter is passed
            to :class:`Credential` or for use when no credential is passed to
            :class:`~gssapi.ctx.InitContext` or :class:`~gssapi.ctx.AcceptContext`. This is only
            an advisory parameter to the GSSAPI implementation.
        :type default: bool
        :param cred_store: Optional dict or list of (key, value) pairs indicating the credential
            store to use. The interpretation of these values will be mechanism-specific.
        :type cred_store: dict, or list of (str, str)
        :returns: A pair of values indicating the set of mechanism OIDs for which credential
            elements were successfully stored, and the usage of the credential that was stored.
        :rtype: tuple(:class:`~gssapi.oids.OIDSet`, int)
        :raises: :exc:`~gssapi.error.GSSException` if there is a problem with storing the
            credential.

            :exc:`NotImplementedError` if the underlying GSSAPI implementation does not
            support the ``gss_store_cred`` or ``gss_store_cred_into`` C functions.
        """
        if usage is None:
            usage = self.usage
        if isinstance(mech, OID):
            oid_ptr = ffi.addressof(mech._oid)
        else:
            oid_ptr = ffi.cast('gss_OID', C.GSS_C_NO_OID)

        minor_status = ffi.new('OM_uint32[1]')
        elements_stored = ffi.new('gss_OID_set[1]')
        usage_stored = ffi.new('gss_cred_usage_t[1]')

        if cred_store is None:
            if not hasattr(C, 'gss_store_cred'):
                raise NotImplementedError("The GSSAPI implementation does not support "
                                          "gss_store_cred")

            retval = C.gss_store_cred(
                minor_status,
                self._cred[0],
                ffi.cast('gss_cred_usage_t', usage),
                oid_ptr,
                ffi.cast('OM_uint32', overwrite),
                ffi.cast('OM_uint32', default),
                elements_stored,
                usage_stored
            )
        else:
            if not hasattr(C, 'gss_store_cred_into'):
                raise NotImplementedError("The GSSAPI implementation does not support "
                                          "gss_store_cred_into")

            c_strings, elements, cred_store_kv_set = _make_kv_set(cred_store)

            retval = C.gss_store_cred_into(
                minor_status,
                self._cred[0],
                ffi.cast('gss_cred_usage_t', usage),
                oid_ptr,
                ffi.cast('OM_uint32', overwrite),
                ffi.cast('OM_uint32', default),
                cred_store_kv_set,
                elements_stored,
                usage_stored
            )
        try:
            if GSS_ERROR(retval):
                if oid_ptr:
                    raise _exception_for_status(retval, minor_status[0], oid_ptr)
                else:
                    raise _exception_for_status(retval, minor_status[0])
        except:
            if elements_stored[0]:
                C.gss_release_oid_set(minor_status, elements_stored)
            raise

        return (OIDSet(elements_stored), usage_stored[0])