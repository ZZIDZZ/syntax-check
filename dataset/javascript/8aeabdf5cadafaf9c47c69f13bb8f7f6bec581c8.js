function RemoveObserver_init(ref, node) {
	let self = Self.get(node);
	if (!self) {
		self = new RemoveObserverPrivate(node);
		Self.set(node, self);
	}
	Self.set(ref, self);
}