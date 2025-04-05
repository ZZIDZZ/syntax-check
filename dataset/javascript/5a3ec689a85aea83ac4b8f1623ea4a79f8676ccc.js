function ( e ) {
		var doclet = e.doclet;
		if (
			doclet.kind === 'class' &&
			doclet.augments !== undefined &&
			doclet.augments.length > 0
		) {
			parents[ doclet.longname ] = doclet.augments[ 0 ];
		}
	}