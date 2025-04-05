public function setHashAlgorithm(string $algorithm): void
    {
        $knownAlgorithms = openssl_get_md_methods(true);

        if (!in_array($algorithm, $knownAlgorithms)) {
            $errorMessage = "The hash algorithm \"$algorithm\" is unknown." .
                'For a list of valid algorithms, see openssl_get_md_methods(true).';
            throw new UnableToHashException($errorMessage);
        }

        $this->hashAlgorithm = $algorithm;
    }