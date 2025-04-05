function( attributes, options ) {
			options || ( options = {} );
			options.create = false;
			return this.findOrCreate( attributes, options );
		}