function initDhtmlxToolbar (container) {
	var impl = null;
	if (Util.isNode(container)) {
		impl = new dhtmlXToolbarObject(container, SKIN);
		
	} else if (container.type === OBJECT_TYPE.LAYOUT_CELL
                || container.type === OBJECT_TYPE.ACCORDION_CELL
		|| container.type === OBJECT_TYPE.LAYOUT
		|| container.type === OBJECT_TYPE.WINDOW
                || container.type === OBJECT_TYPE.TAB) {
		
		impl = container.impl.attachToolbar();
		impl.setSkin(SKIN);
	} else {
		throw new Error('initDhtmlxToolbar: container is not valid.');
	}
	return impl;
}