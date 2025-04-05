func (role *Role) Get(name string) (Checker, bool) {
	fc, ok := role.definitions[name]
	return fc, ok
}