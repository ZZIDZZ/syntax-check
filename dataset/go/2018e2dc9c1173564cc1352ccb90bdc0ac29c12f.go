func (g Garbler) punctuate(p string, numPunc int) string {
	if numPunc <= 0 {
		return p
	}
	ret := p
	for i := 0; i < numPunc; i++ {
		if i%2 == 0 {
			ret += string(Punctuation[randInt(len(Punctuation))])
		} else {
			ret = string(Punctuation[randInt(len(Punctuation))]) + ret
		}
	}
	return ret
}