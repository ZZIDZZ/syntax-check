private function copyValuesFromParentToProject($key, array &$config)
    {
        if (empty($config[$key])) {
            return;
        }

        foreach ($config['projects'] as &$project) {
            if (empty($project[$key])) {
                $project[$key] = $config[$key];
            }
        }
    }