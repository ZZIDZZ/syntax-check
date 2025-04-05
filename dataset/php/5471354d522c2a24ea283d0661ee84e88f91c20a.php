protected function getSleepSeconds($attempts, $maxAttempts = null)
    {
        if ($maxAttempts && $attempts >= $maxAttempts) {
            return false;
        }

        // very complex.
        return $attempts * $attempts;
    }