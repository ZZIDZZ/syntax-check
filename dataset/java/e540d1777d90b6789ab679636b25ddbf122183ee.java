protected X509Certificate findIntermediate(X509Certificate certificate) throws OcspException {
        for (X509Certificate issuer : properties.get(INTERMEDIATES))
            if (issuer.getSubjectX500Principal().equals(certificate.getIssuerX500Principal()))
                return issuer;

        throw new OcspException("Unable to find issuer '%s'.", certificate.getIssuerX500Principal().getName());
    }