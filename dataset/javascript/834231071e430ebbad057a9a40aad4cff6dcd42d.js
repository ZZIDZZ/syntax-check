function Ebus(p) {
	"use strict";
	
	this.debug = false;
	this.yields = false;
	this.handlers = {};

	if (p) {
		this.priorities = p;
	} else {
		this.priorities = {};
	}
}