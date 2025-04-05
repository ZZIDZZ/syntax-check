func DecodeString(raw string) ([]byte, error) {
	pad := 8 - (len(raw) % 8)
	nb := []byte(raw)
	if pad != 8 {
		nb = make([]byte, len(raw)+pad)
		copy(nb, raw)
		for i := 0; i < pad; i++ {
			nb[len(raw)+i] = '='
		}
	}

	return lowerBase32.DecodeString(string(nb))
}