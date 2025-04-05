function bindEventMap(eventMap, eventEmitter) {
	var eventNames = Object.keys(eventMap);
	eventNames.map(function (eventName) {
		eventEmitter.on(eventName, eventMap[eventName]);
	});
}