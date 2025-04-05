func (controller) InlineEdit(context *admin.Context) {
	context.Writer.Write([]byte(context.Render("action_bar/inline_edit")))
}