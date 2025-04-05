function URLSearchParamsPolyfill(search) {
        search = search || "";

        // support construct object with another URLSearchParams instance
        if (search instanceof URLSearchParams || search instanceof URLSearchParamsPolyfill) {
            search = search.toString();
        }
        this [__URLSearchParams__] = parseToDict(search);
    }