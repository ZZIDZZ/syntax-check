function render(processor, source) {
	try {
		return processor.processSync(source).contents;
	} catch (exception) {
		const error = `Error while rendering Markdown: ${exception.message}`;
		console.error(error);
		return errorInlineHtml(error).toString();
	}
}