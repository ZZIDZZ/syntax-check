func (this *HawkSignatureAuthenticationResponse) MarshalJSON() ([]byte, error) {
	x := json.RawMessage(*this)
	return (&x).MarshalJSON()
}