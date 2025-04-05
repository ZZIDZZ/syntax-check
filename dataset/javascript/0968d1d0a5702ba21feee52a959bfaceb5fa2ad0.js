function (application_secret, token_secret, signature_base) {
        var passphrase;
        var signature;

        application_secret = encode(application_secret);
        token_secret = encode(token_secret || '');

        passphrase = application_secret + '&' + token_secret;
        signature = Cryptography.hmac(Cryptography.SHA1, passphrase, signature_base);

        return btoa(signature);
    }