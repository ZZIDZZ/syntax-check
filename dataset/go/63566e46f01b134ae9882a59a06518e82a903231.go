func (render *Render) Asset(name string) ([]byte, error) {
	return render.AssetFileSystem.Asset(name)
}