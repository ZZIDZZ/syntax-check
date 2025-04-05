func NewTgzWalker(pkgReader io.Reader) Walker {
	return tgzWalker{
		pkgReader: pkgReader,
		callbacks: make(map[*regexp.Regexp]WalkFunc),
	}
}