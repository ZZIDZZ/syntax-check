func (a *Auth) ValidateOU(verifiedCert *x509.Certificate) error {
	var failed []string

	for _, ou := range a.opt.AllowedOUs {
		for _, clientOU := range verifiedCert.Subject.OrganizationalUnit {
			if ou == clientOU {
				return nil
			}
			failed = append(failed, clientOU)
		}
	}
	return fmt.Errorf("cert failed OU validation for %v, Allowed: %v", failed, a.opt.AllowedOUs)
}