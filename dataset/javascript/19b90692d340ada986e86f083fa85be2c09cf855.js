function urlFormat(obj) {
    // ensure it's an object, and not a string url.
    // If it's an obj, this is a no-op.
    // this way, you can call url_format() on strings
    // to clean up potentially wonky urls.
    if (isString(obj)) {
        obj = urlParse(obj);
    } else if (!isObject(obj) || isNull(obj)) {
        throw new TypeError('Parameter "urlObj" must be an object, not ' +
            isNull(obj) ? 'null' : typeof obj);
    } else if (!(obj instanceof Url)) {
        return Url.prototype.format.call(obj);
    } else {
        return obj.format();
    }
}