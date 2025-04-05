public function startTransaction(string $appname, string $license = null): bool
    {
        if (!$this->isLoaded()) {
            return false;
        }

        if (isset($license)) {
            return newrelic_start_transaction($appname, $license);
        }

        return newrelic_start_transaction($appname);
    }