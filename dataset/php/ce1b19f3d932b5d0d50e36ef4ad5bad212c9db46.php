public function loadUserByUsername($username)
    {
        $qb = $this->_conn->createQueryBuilder();

        $qb->select('su.username, su.password')
            ->from('security_users', 'su')
            ->where(
                $qb->expr()->orX(
                    $qb->expr()->eq('su.username', ':username'),
                    $qb->expr()->eq('su.email', ':username')
                )
            )
            ->setParameter(':username', strtolower($username));
        $stmt = $qb->execute();

        if (!$user = $stmt->fetch()) {
            throw new UsernameNotFoundException(
                sprintf('Username "%s" does not exist.', $username)
            );
        }

        $qb->select('sr.role')
            ->leftJoin('su', 'security_users_roles', 'sur', 'su.id = sur.user_id')
            ->innerJoin('sur', 'security_roles', 'sr', 'sur.role_id = sr.id');

        $stmt = $qb->execute();
        $roles = $stmt->fetchAll(\PDO::FETCH_COLUMN);

        return new User($user['username'], $user['password'], $roles);
    }