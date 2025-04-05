public static function create($conn, Configuration $config, EventManager $eventManager = null)
    {
        try{
            return self::getEntityManager()->create($conn, $config, $eventManager);
        } catch(ORMException $e) {
            if (!self::getEntityManager()->isOpen()) {
                self::resetEntityManager();
            }
            throw $e;
        }
    }