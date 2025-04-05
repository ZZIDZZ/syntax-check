function insertIntoList(item, position, list)
{
	var before = list.slice(0, position);
	var after  = list.slice(position);

	return before.push(item).concat(after)
}