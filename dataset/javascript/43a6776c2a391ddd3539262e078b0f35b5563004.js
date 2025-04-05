function bilinear(e) {

	const a = lerp(e[0], e[1], 1.0 - 0.25);
	const b = lerp(e[2], e[3], 1.0 - 0.25);

	return lerp(a, b, 1.0 - 0.125);

}