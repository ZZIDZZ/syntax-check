protected function getPostMessage(array $pending, $name)
    {
        if ($name) {
            $pending = array_filter($pending, function (BinaryInterface $binary) use ($name) {
                return $binary->getName() === $name;
            });
        }

        $count = array_reduce($pending, function ($r, BinaryInterface $binary) {
            if ($binary->exists($this->manager->getInstallPath())) {
                $r++;
            }
            return $r;
        }, 0);

        return $this->getResultString($count);
    }