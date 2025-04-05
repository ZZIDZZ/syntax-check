function(structure = []) {

		return new Promise((resolve, reject) => {

			if (Array.isArray(structure) === false) {
				throw new Error(`'structure' must be an array`)
			}

			parseStructure(structure, opts.cwd)
				.then((parsedStructure) => writeStructure(parsedStructure))
				.then((parsedStructure) => binStructure(parsedStructure, bin, opts.persistent))
				.then(resolve, reject)

		})

	}