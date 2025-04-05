function(obj) {
		var matches = this.sequence[0].matches(obj);
		for(var i = 1; i < this.sequence.length; i += 2) {
			if(this.sequence[i] === '&')
				matches = matches && this.sequence[i+1].matches(obj);
			else
				matches = matches || this.sequence[i+1].matches(obj);
		}
		return matches;
	}