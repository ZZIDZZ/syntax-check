function createSession(SessionManager $sessionManager, $userProfile = null)
    {
        $sessionLifeTime = $sessionManager->getSessionConfig()->getLifetime();
        $initialData = [];
        $profiles = [];
        if ($userProfile) {
            $profiles = [$userProfile];
        }
        $initialData['profiles'] = $profiles;
        $initialData['data'] = [];
        $dataString = $this->serializer->serialize($initialData);

        $lockToken = null;

        for ($count = 0; $count < 10; $count++) {
            $sessionId = $this->idGenerator->generateSessionID();
            $lockToken = $this->acquireLockIfRequired($sessionId, $sessionManager);
            $dataKey = generateSessionDataKey($sessionId);
            $set = $this->redisClient->set(
                $dataKey,
                $dataString,
                'EX',
                $sessionLifeTime,
                'NX'
            );

            if ($set) {
                return new RedisSession(
                    $sessionId,
                    $this,
                    $sessionManager,
                    [],
                    $profiles,
                    false,
                    $lockToken
                );
            }

            if ($lockToken !== null) {
                $this->releaseLock($sessionId, $lockToken);
            }
        }

        throw new AsmException(
            "Failed to createSession.",
            AsmException::ID_CLASH
        );
    }