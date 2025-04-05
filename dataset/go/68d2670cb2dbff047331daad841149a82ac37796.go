func (g *Glg) isModeEnable(l LEVEL) bool {
	return g.GetCurrentMode(l) != NONE
}