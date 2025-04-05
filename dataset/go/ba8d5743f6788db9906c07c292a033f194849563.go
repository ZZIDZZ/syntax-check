func IsPrivate(ip net.IP) bool {
	for _, ipnet := range privateNets {
		if ipnet.Contains(ip) {
			return true
		}
	}
	return false
}