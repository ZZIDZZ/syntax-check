public function findByIssue(
        IssueInterface $issue,
        \DateTime $createdAt = null,
        $writtenBy = null,
        $limit = null,
        $offset = null
    ) {
        $queryBuilder = $this->getQueryBuilder();
        if ($createdAt instanceof \DateTime) {
            $this->addCriteria($queryBuilder, ['between' => ['createdAt' => $createdAt]]);
        }
        if ($writtenBy !== null) {
            $this->addCriteria($queryBuilder, ['wb.email' => $writtenBy]);
        }
        $this->addCriteria($queryBuilder, ['issue' => $issue]);
        $this->orderBy($queryBuilder, ['createdAt' => 'ASC']);

        if ($limit) {
            $queryBuilder->setMaxResults($limit);
        }
        if ($offset) {
            $queryBuilder->setFirstResult($offset);
        }

        return $queryBuilder->getQuery()->getResult();
    }