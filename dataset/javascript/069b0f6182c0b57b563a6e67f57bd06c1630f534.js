function validate(str) {
    let tj;

    if (typeof str === 'object') {
        tj = str;
    } else if (typeof str === 'string') {
        try {
            tj = jsonlint.parse(str);
        } catch (err) {
            return false;
        }
    } else {
        return false;
    }

    return tilejsonValidateObject.validate(tj);
}