function recover(data, encoding = "utf8") {
        if (typeof data === "string") {
            data = Buffer.from(data, encoding);
        }
        assert(Buffer.isBuffer(data), "data is a required String or Buffer");
        data = hash.sha256(data);

        return recoverHash(data);
    }