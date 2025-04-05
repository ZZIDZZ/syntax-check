protected function expires(DateTimeImmutable $now, string $expires = null)
    {
        return !$expires ? null : $now->modify($expires)->getTimestamp();
    }