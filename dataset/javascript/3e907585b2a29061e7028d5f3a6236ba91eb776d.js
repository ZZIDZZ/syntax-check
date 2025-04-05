function (map, receive) {
	var entries = mapEntries.call(map);
	var next;
	do {
		next = entries.next();
	} while (!next.done && receive(next.value));
}