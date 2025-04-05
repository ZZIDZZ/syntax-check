public function convert(Query $query): QueryBuilder
    {
        $queryBuilder = $this->entityManager
            ->getRepository($query->getClassFqn())
            ->createQueryBuilder(self::FROM_ALIAS);

        $this->buildSelects($queryBuilder, $query);
        $this->buildJoins($queryBuilder, $query);

        if ($query->hasExpression()) {
            $this->buildWhere($queryBuilder, $query);
        }

        $this->buildOrderings($queryBuilder, $query);
        $this->buildLimit($queryBuilder, $query);

        return $queryBuilder;
    }