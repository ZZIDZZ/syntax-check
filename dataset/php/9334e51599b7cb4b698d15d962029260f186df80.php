private function validateEntityManagers(array &$config): bool
    {
        $dependenciesInstalled = class_exists(EntityManager::class);
        $entityManagersConfigured = !empty($config['entity_managers']);

        if ($dependenciesInstalled && !$entityManagersConfigured) {
            // Add default entity manager if none set.
            $config['entity_managers']['default'] = ['client' => 'default'];
        } elseif (!$dependenciesInstalled && $entityManagersConfigured) {
            throw new \LogicException(
                'You need to install "graphaware/neo4j-php-ogm" to be able to use the EntityManager'
            );
        }

        return $dependenciesInstalled;
    }