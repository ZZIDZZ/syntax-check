public static DistinguishedName getFullDn(DistinguishedName dn, Context baseCtx)
			throws NamingException {
		DistinguishedName baseDn = new DistinguishedName(baseCtx.getNameInNamespace());

		if (dn.contains(baseDn)) {
			return dn;
		}

		baseDn.append(dn);

		return baseDn;
	}