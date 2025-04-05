func UnmarshalEd25519PrivateKey(data []byte) (PrivKey, error) {
	switch len(data) {
	case ed25519.PrivateKeySize + ed25519.PublicKeySize:
		// Remove the redundant public key. See issue #36.
		redundantPk := data[ed25519.PrivateKeySize:]
		pk := data[ed25519.PrivateKeySize-ed25519.PublicKeySize : ed25519.PrivateKeySize]
		if !bytes.Equal(pk, redundantPk) {
			return nil, errors.New("expected redundant ed25519 public key to be redundant")
		}

		// No point in storing the extra data.
		newKey := make([]byte, ed25519.PrivateKeySize)
		copy(newKey, data[:ed25519.PrivateKeySize])
		data = newKey
	case ed25519.PrivateKeySize:
	default:
		return nil, fmt.Errorf(
			"expected ed25519 data size to be %d or %d, got %d",
			ed25519.PrivateKeySize,
			ed25519.PrivateKeySize+ed25519.PublicKeySize,
			len(data),
		)
	}

	return &Ed25519PrivateKey{
		k: ed25519.PrivateKey(data),
	}, nil
}