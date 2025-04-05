private function getParentAlias(ProxyQueryInterface $queryBuilder, $alias)
    {
        $parentAlias = $rootAlias = current($queryBuilder->getRootAliases());
        $joins = $queryBuilder->getDQLPart('join');
        if (isset($joins[$rootAlias])) {
            foreach ($joins[$rootAlias] as $join) {
                if ($join->getAlias() === $alias) {
                    $parts = explode('.', $join->getJoin());
                    $parentAlias = $parts[0];

                    break;
                }
            }
        }

        return $parentAlias;
    }