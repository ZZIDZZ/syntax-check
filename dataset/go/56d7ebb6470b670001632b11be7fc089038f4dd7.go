func (ctx *Context) StartSession(f session.FactoryFunc) (err error) {
	ctx.Session, err = f(ctx.Response, ctx.Request)
	return
}