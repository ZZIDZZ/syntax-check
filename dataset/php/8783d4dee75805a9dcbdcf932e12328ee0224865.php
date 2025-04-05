public function register() {
        $this->loadEntitiesFrom(__DIR__);

        $this->app->singleton('migration.repository', function($app) {
            return new DoctrineMigrationRepository(
                function() use($app) {
                    return $app->make(EntityManagerInterface::class);
                },
                function() use($app) {
                    return $app->make(SchemaTool::class);
                },
                function() use($app) {
                    return $app->make(ClassMetadataFactory::class);
                }
            );
        });
        $this->app->bind(MigrationRepositoryInterface::class, 'migration.repository');
    }