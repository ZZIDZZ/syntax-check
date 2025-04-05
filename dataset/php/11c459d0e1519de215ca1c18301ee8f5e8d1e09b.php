public function publishDateStatus()
    {
        $now = new DateTime();
        $publish = $this->publishDate();
        $expiry  = $this->expiryDate();
        $status  = $this->publishStatus();

        if ($status !== static::STATUS_PUBLISHED) {
            return $status;
        }

        if (!$publish) {
            if (!$expiry || $now < $expiry) {
                return static::STATUS_PUBLISHED;
            } else {
                return static::STATUS_EXPIRED;
            }
        } else {
            if ($now < $publish) {
                return static::STATUS_UPCOMING;
            } else {
                if (!$expiry || $now < $expiry) {
                    return static::STATUS_PUBLISHED;
                } else {
                    return static::STATUS_EXPIRED;
                }
            }
        }
    }