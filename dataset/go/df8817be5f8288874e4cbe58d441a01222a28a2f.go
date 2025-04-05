func (m *monitorableWriter) Log() {
	duration := time.Now().Sub(m.t0)
	if m.Code == 0 {
		m.Code = 200
	}
	if m.opts.Filter != nil && !m.opts.Filter(m.r, m.Code, duration, m.Size) {
		return //skip
	}
	cc := m.colorCode()
	size := ""
	if m.Size > 0 {
		size = sizestr.ToString(m.Size)
	}
	buff := bytes.Buffer{}
	m.opts.formatTmpl.Execute(&buff, &struct {
		*Colors
		Timestamp, Method, Path, CodeColor string
		Code                               int
		Duration, Size, IP                 string
	}{
		m.opts.Colors,
		m.t0.Format(m.opts.TimeFormat), m.method, m.path, cc,
		m.Code,
		fmtDuration(duration), size, m.ip,
	})
	//fmt is threadsafe :)
	fmt.Fprint(m.opts.Writer, buff.String())
}