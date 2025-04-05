function click(e) {
		var op = 'remove';
		if (this.className==='menuLink') {
			op = document.body.classList.contains('menu-open') ? 'remove' : 'add';
			e.preventDefault();
		}
		document.body.classList[op]('menu-open');
	}