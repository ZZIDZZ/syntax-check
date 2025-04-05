protected function setThemeResolver(Application $app, Theme $theme): void
    {
        // The theme is only booted when the first view is being composed.
        // This would prevent multiple theme being booted in the same
        // request.
        if ($app->resolved('view')) {
            $theme->resolving();
        } else {
            $app->resolving('view', function () use ($theme) {
                $theme->resolving();
            });
        }
    }