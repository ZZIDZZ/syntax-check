protected function linesRemovedOrModified(
        array $ancestor,
        array $local,
        array $remote,
        $count_ancestor,
        $count_local,
        $count_remote
    ) {
        $merged = [];
        $count_array = [$count_ancestor, $count_local, $count_remote];
        sort($count_array);
        $mincount = min($count_local, $count_ancestor, $count_remote);

        // First for loop compares all 3 nodes and returns updated node.
        for ($key = 0; $key < $mincount; $key++) {
            if ($ancestor[$key] == $local[$key]) {
                $merged[$key] = $remote[$key];
            } elseif ($ancestor[$key] == $remote[$key]
                || $local[$key] == $remote[$key]) {
                $merged[$key] = $local[$key];
            } else {
                throw new ConflictException("A conflict has occured");
            }
        }

        for ($key = $mincount; $key < $count_array[1]; $key++) {
            if ($mincount == $count_local && $ancestor[$key] != $remote[$key]) {
                throw new ConflictException("A whole new conflict arised");
            } elseif ($mincount == $count_remote
                && $ancestor[$key] != $local[$key]) {
                throw new ConflictException("A whole new conflict arised");
            }
        }
        return $merged;
    }