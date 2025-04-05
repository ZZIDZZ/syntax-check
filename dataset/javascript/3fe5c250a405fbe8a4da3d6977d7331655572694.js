function pbkdf2(password, salt, rounds, bits) {
    return new Promise((resolve, reject) => {
        deriveKey(password, salt, rounds, bits / 8, DERIVED_KEY_ALGORITHM, (err, key) => {
            if (err) {
                return reject(err);
            }
            return resolve(key);
        });
    });
}