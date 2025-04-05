function Draggable(target, options) {
	if (!(this instanceof Draggable)) {
		return new Draggable(target, options);
	}

	var that = this;

	//ignore existing instance
	var instance = draggableCache.get(target);
	if (instance) {
		instance.state = 'reset';

		//take over options
		extend(instance, options);

		instance.update();

		return instance;
	}

	else {
		//get unique id for instance
		//needed to track event binders
		that.id = getUid();
		that._ns = '.draggy_' + that.id;

		//save element passed
		that.element = target;

		draggableCache.set(target, that);
	}

	//define state behaviour
	defineState(that, 'state', that.state);

	//preset handles
	that.currentHandles = [];

	//take over options
	extend(that, options);

	//define handle
	if (that.handle === undefined) {
		that.handle = that.element;
	}

	//setup droppable
	if (that.droppable) {
		that.initDroppable();
	}

	//try to calc out basic limits
	that.update();

	//go to initial state
	that.state = 'idle';
}