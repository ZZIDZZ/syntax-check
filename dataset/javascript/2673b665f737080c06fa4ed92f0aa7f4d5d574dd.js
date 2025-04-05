function hoistFunctions(program) {
	var functions = [];
	var body = [];
	for (let line of program.body) {
		if (line.type === 'ExportDefaultDeclaration') {
			if (line.declaration.type === 'FunctionDeclaration') {
				functions.push(line);
			} else {
				body.push(line);
			}

			continue;
		}

		if (line.type === 'ExportNamedDeclaration') {
			if (!!line.declaration &&
				line.declaration.type === 'FunctionDeclaration') {

				functions.push(line);
			} else {
				body.push(line);
			}

			continue;
		}

		if (line.type === 'FunctionDeclaration') {
			functions.push(line);
		} else {
			body.push(line);
		}
	}

	return makeProgram([...functions, ...body]);
}