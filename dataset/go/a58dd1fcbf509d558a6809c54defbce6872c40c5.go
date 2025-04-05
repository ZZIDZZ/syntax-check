func GetRanges(ips []string, ip4_cidr string, ip6_cidr string) ([]net.IPNet, error) {
	net_out := make([]net.IPNet, 0)

	for _, ip := range ips {
		cidr := ""
		if strings.Contains(ip, ":") {
			// IPv6
			cidr = ip6_cidr
			if cidr == "" {
				cidr = "128"
			}
			if c, err := strconv.ParseInt(cidr, 10, 16); err != nil || c < 0 || c > 128 {
				return nil, &PermError{"Invalid IPv6 CIDR length: " + cidr}
			}

		} else {
			// IPv4
			cidr = ip4_cidr
			if cidr == "" {
				cidr = "32"
			}
			if c, err := strconv.ParseInt(cidr, 10, 16); err != nil || c < 0 || c > 32 {
				return nil, &PermError{"Invalid IPv4 CIDR length: " + cidr}
			}
		}
		ip += "/" + cidr

		_, ipnet, err := net.ParseCIDR(ip)
		if err != nil {
			return nil, err
		}
		net_out = append(net_out, *ipnet)

	}

	return net_out, nil
}