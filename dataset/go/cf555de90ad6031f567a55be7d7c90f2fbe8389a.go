func Generate(p Policy) (string, error) {

	// Character length based policies should not be negative
	if p.MinLength < 0 || p.MaxLength < 0 || p.MinUppers < 0 ||
		p.MinLowers < 0 || p.MinDigits < 0 || p.MinSpclChars < 0 {
		return "", ErrNegativeLengthNotAllowed
	}

	collectiveMinLength := p.MinUppers + p.MinLowers + p.MinDigits + p.MinSpclChars

	// Min length is the collective min length
	if collectiveMinLength > p.MinLength {
		p.MinLength = collectiveMinLength
	}

	// Max length should be greater than collective minimun length
	if p.MinLength > p.MaxLength {
		return "", ErrMaxLengthExceeded
	}

	if p.MaxLength == 0 {
		return "", nil
	}

	capsAlpha := []byte(p.UpperPool)
	smallAlpha := []byte(p.LowerPool)
	digits := []byte(p.DigitPool)
	spclChars := []byte(p.SpclCharPool)
	allChars := []byte(p.UpperPool + p.LowerPool + p.DigitPool + p.SpclCharPool)

	passwd := CreateRandom(capsAlpha, p.MinUppers)

	passwd = append(passwd, CreateRandom(smallAlpha, p.MinLowers)...)
	passwd = append(passwd, CreateRandom(digits, p.MinDigits)...)
	passwd = append(passwd, CreateRandom(spclChars, p.MinSpclChars)...)

	passLen := len(passwd)

	if passLen < p.MaxLength {
		randLength := random(p.MinLength, p.MaxLength)
		passwd = append(passwd, CreateRandom(allChars, randLength-passLen)...)
	}

	Shuffle(passwd)

	return string(passwd), nil
}