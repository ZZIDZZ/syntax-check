function getBrightness( hex ) {
        var r = parseInt( hex.substr(2+0*2, 2), 16),
		    g = parseInt( hex.substr(2+1*2, 2), 16),
		    b = parseInt( hex.substr(2+2*2, 2), 16);

    	function lin2log(n) { return n <= 0.0031308 ? n * 12.92 : 1.055 * Math.pow(n,1/2.4) - 0.055; }
        function log2lin(n) { return n <= 0.04045   ? n / 12.92 : Math.pow(((n + 0.055)/1.055),2.4); }
		r = log2lin( r/255 );
	    g = log2lin( g/255 );
    	b = log2lin( b/255 );
		return lin2log(0.2126 * r + 0.7152 * g + 0.0722 * b) * 100;
	}