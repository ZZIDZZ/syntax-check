func Checksum64S(in []byte, seed uint64) uint64 {
	if len(in) == 0 && seed == 0 {
		return 0xef46db3751d8e999
	}

	if len(in) > 31 {
		return checksum64(in, seed)
	}

	return checksum64Short(in, seed)
}