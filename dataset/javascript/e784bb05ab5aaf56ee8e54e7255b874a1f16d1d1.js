function consecutive(first, second) {
                    var length = d3.keys(__.dimensions).length;
                    return d3.keys(__.dimensions).some(function(d, i) {
                        return (d === first)
                            ? i + i < length && __.dimensions[i + 1] === second
                            : false;
                    });
                }