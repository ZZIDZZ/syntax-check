function locationStr( runtime , line ) {
	var loc ;
	loc = 'line: ' + ( line !== undefined ? line : runtime.lineNumber ) ;
	if ( runtime.file ) { loc += ' -- file: ' + runtime.file ; }
	return loc ;
}