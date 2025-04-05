function (pagesPath, allPartials) {
			if (options.verbose) {
				grunt.log.writeln('- using pages path: %s', pagesPath);
			}
			var allPages = {};

			// load fileGlobals from file in [src]/globals.json
			if (grunt.file.exists(options.src + '/globals.json')) {
				fileGlobals = grunt.file.readJSON(options.src + '/globals.json');
				gruntGlobals = mergeObj(gruntGlobals, fileGlobals);
			}

			// for all files in dir
			grunt.file.recurse(pagesPath, function (absPath, rootDir, subDir, fileName) {

				// file extension does not match - ignore
				if (!fileName.match(tplMatcher)) {
					if (options.verbose) {
						grunt.log.writeln('-- ignoring file: %s', fileName);
					}
					return;
				}

				var pageName = absPath.replace(rootDir, '').replace(tplMatcher, '').substring(1),
				    pageSrc = grunt.file.read(absPath),
				    pageJson = {},
				    dataPath = absPath.replace(tplMatcher, '.json'),
				    compiledPage = Hogan.compile(pageSrc); // , { sectionTags: [{o:'_i', c:'i'}] }

				if (options.verbose) {
					grunt.log.writeln('-- compiled page: %s', pageName);
				}

				// read page data from {pageName}.json
				if (grunt.file.exists(dataPath)) {
					if (options.verbose) {
						grunt.log.writeln('--- using page data from: %s', dataPath);
					}
					pageJson = grunt.file.readJSON(dataPath);
					pageData[pageName] = mergeObj(gruntGlobals, pageJson);

					if (options.verbose) {
						grunt.log.writeln('--- json for %s', pageName, pageData[pageName]);
					}
				} else {
					pageData[pageName] = gruntGlobals;
				}

				allPages[pageName] = compiledPage.render(pageData[pageName], allPartials);
			});

			return allPages;
		}