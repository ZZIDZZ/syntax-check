function (obj, removeProp) {
        var newObj = {};
        for (var prop in obj) {
            if (!obj.hasOwnProperty(prop) || prop === removeProp) {
                continue;
            }
            newObj[prop] = obj[prop];
        }

        return newObj;
    }