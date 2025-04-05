function parseIPv4(addr) {
        if (typeof(addr) !== 'string')
                throw new TypeError('addr (string) is required');

        var octets = addr.split(/\./).map(function (octet) {
                return (parseInt(octet, 10));
        });
        if (octets.length !== 4)
                throw new TypeError('valid IP address required');

        var uint32 = ((octets[0] * Math.pow(256, 3)) +
                      (octets[1] * Math.pow(256, 2)) +
                      (octets[2] * 256) + octets[3]);
        return (uint32);
}