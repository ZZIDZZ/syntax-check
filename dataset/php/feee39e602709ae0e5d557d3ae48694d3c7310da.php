protected function _hashCallable($callable)
    {
        $key = null;

        if (is_string($callable) || $callable instanceof Stringable) {
            $key = $this->_normalizeString($callable);
        } elseif (is_object($callable)) {
            $key = spl_object_hash($callable);
        } elseif (is_array($callable) && count($callable) == 2) {
            $part1 = is_object($callable[0])
                ? spl_object_hash($callable[0])
                : $this->_normalizeString($callable[0]);
            $part2 = $this->_normalizeString($callable[1]);

            $key = serialize([$part1, $part2]);
        }

        if ($key === null) {
            throw $this->_createInvalidArgumentException(
                $this->__('Failed to hash - not a valid callable'),
                null,
                null,
                $callable
            );
        }

        return sha1($key);
    }