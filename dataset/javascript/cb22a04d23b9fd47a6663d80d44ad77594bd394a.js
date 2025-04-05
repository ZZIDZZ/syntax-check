function toColormap (data) {
	var stops = [];

	for (var i = 0; i < data.length; i++) {
		stops.push({
			index: Math.round(i * 100 / (data.length - 1)) / 100,
			rgb: data[i].map((v) => Math.round(v*255))
		});
	}

	return stops;
}