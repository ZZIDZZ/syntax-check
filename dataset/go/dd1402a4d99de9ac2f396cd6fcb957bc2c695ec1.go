func Usaget(prefix string, spec interface{}, out io.Writer, tmpl *template.Template) error {
	// gather first
	infos, err := gatherInfo(prefix, spec)
	if err != nil {
		return err
	}

	return tmpl.Execute(out, infos)
}