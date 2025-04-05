function detectNumberSeparators() {
	var n = 1000.50;
	var l = n.toLocaleString();
	var s = n.toString();
	var o = {
		decimal: l.substring(5,6),
		thousands: l.substring(1,2)
	};

	if (l.substring(5,6) == s.substring(5,6)) {
		o.decimal = ".";
	}
	if (l.substring(1,2) == s.substring(1,2)) {
		o.thousands = ",";
	}

	return o;
}