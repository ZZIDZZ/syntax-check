function stringify(obj) {
        var arr = [];
        for (var x in obj) {
            arr.push(encodeURIComponent(x) + "=" + encodeURIComponent(obj[x]));
        }
        return arr.join("&");
    }