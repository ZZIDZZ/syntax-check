function writeFile(resHtml, outputPath) {
	fs.writeFile(outputPath, resHtml, function (err) {
		if (err) {
			console.log('');
			console.log('File error: ' + err + '. Exit.');
		} else {
			console.log('');
			console.log('All done. Exit.'.green);
		}
	});
}