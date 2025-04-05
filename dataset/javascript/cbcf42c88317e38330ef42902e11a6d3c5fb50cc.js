function handleResponse(res, data, callback) {
    // HTTP 204 doesn't have a response
    var json = data && JSON.parse(data) || {};

    if ((res.statusCode >= 200) && (res.statusCode <= 206)) {
        // Handle a few known responses
        switch (json.message) {
            case 'Bad credentials':
                callback.call(this, json);
                break;

            default:
                callback.call(this, null, json);
        }
    } else {
        callback.call(this, json);
    }
}