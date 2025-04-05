function (el, options) {
	events.EventEmitter.call(this);

	this.el = el;
	this.options = extend({}, this.options);
	extend(this.options, options);
	this.showTab = this._show;
	this._init();
}