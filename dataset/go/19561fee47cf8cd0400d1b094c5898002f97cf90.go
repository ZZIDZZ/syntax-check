func (p *Process) DynamicType(t *Type, a core.Address) *Type {
	switch t.Kind {
	default:
		panic("asking for the dynamic type of a non-interface")
	case KindEface:
		x := p.proc.ReadPtr(a)
		if x == 0 {
			return nil
		}
		return p.runtimeType2Type(x)
	case KindIface:
		x := p.proc.ReadPtr(a)
		if x == 0 {
			return nil
		}
		// Read type out of itab.
		x = p.proc.ReadPtr(x.Add(p.proc.PtrSize()))
		return p.runtimeType2Type(x)
	}
}