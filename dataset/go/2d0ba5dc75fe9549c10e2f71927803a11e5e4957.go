func Renderer(options ...RenderOptions) Handler {
	opt := prepareRenderOptions(options)
	cs := prepareCharset(opt.Charset)
	t := compile(opt)
	return func(res http.ResponseWriter, req *http.Request, c Context) {
		var tc *template.Template
		if Env == Dev {
			// recompile for easy development
			tc = compile(opt)
		} else {
			// use a clone of the initial template
			tc, _ = t.Clone()
		}
		//c.MapTo(&Render{res, req, tc, opt, cs, Data}, (*Render)(nil))
		c.Map(&Render{res, req, tc, opt, cs, Data})
	}
}