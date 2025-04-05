function toParam(obj, dontEncode) {
    const arr = [];
    let vals;

    if (isObject(obj) && !isArray(obj)) {
        Object.keys(obj).forEach((val) => {
            if (isArray(obj[val])) {
                vals = `[${
                    obj[val].map(v => (isNaN(v) ? `"${v}"` : v)).join(',')
                }]`;
            } else {
                vals = isNaN(obj[val]) ? `"${obj[val]}"` : obj[val];
            }
            arr.push(`${val}:${vals}`);
        });

        if (dontEncode) {
            return `{${arr.join(',')}}`;
        }

        return encodeURIComponent(`{${arr.join(',')}}`);
    }

    return '';
}