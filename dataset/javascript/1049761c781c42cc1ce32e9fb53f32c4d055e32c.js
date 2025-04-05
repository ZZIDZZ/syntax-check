function renderPages(filepaths, dest, {templates, vars, statics, disableValidation, cssVariables, host}) {
	console.log(`\nGenerating pages...`);
	return Promise.all(filepaths.map(filepath => {
		return sander.readFile(filepath)
			.then(content => renderPage(content, filepath, {templates, vars, dest, cssVariables}))
			.then(([html, destinationPath, cssParts]) => sander.writeFile(destinationPath, html)
				.then(() => [destinationPath, cssParts]))
			.then(([destinationPath, cssParts]) => {
				console.log(`  ${chalk.bold.green(figures.tick)} ${filepath} -> ${destinationPath}`);
				return [destinationPath, cssParts];
			});
	}))
	.then(pageResults => disableValidation ||
		validatePages(host, dest, pageResults.map(result => result[0]), statics)
			.then(() => pageResults.map(result => result[1])));
}