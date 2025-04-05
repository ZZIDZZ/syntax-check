private static State extractValues(final List<Object> values, final Map<ExpectedLabels, Integer> map) {
		final ZonedDateTime time = ZonedDateTime.parse((String) values.get(map.get(ExpectedLabels.time)));
		final int temp = safeInt((Integer) values.get(map.get(ExpectedLabels.temp)));
		final int pressure = safeInt((Integer) values.get(map.get(ExpectedLabels.pressure)));
		final int humidity = safeInt((Integer) values.get(map.get(ExpectedLabels.humidity)));
		final int voc = safeInt((Integer) values.get(map.get(ExpectedLabels.voc)));
		final int light = safeInt((Integer) values.get(map.get(ExpectedLabels.light)));
		final int noise = safeInt((Integer) values.get(map.get(ExpectedLabels.noise)));
		final int noisedba = safeInt((Integer) values.get(map.get(ExpectedLabels.noisedba)));
		final int battery = safeInt((Integer) values.get(map.get(ExpectedLabels.battery)));
		final boolean shake = safeBoolean((Boolean) values.get(map.get(ExpectedLabels.shake)));
		final boolean cable = safeBoolean((Boolean) values.get(map.get(ExpectedLabels.cable)));
		final int vocResistance = safeInt((Integer) values.get(map.get(ExpectedLabels.voc_resistance)));
		final int rssi = safeInt((Integer) values.get(map.get(ExpectedLabels.rssi)));
		return new State(time, temp, pressure, humidity, voc, light, noise, noisedba, battery, shake, cable, vocResistance, rssi);
	}