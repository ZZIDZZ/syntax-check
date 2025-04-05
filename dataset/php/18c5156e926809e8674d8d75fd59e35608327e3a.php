protected function setupPaths(Client $client, $strip, $project)
    {
        if ($strip) {
            $client->setStripPath($strip);

            if (!$project) {
                $client->setProjectRoot("{$strip}/src");
            }

            return;
        }

        $base = realpath(__DIR__.'/../../../../');

        if ($project) {
            if ($base && substr($project, 0, strlen($base)) === $base) {
                $client->setStripPath($base);
            }

            $client->setProjectRoot($project);

            return;
        }

        if ($base) {
            $client->setStripPath($base);

            if ($root = realpath("{$base}/src")) {
                $client->setProjectRoot($root);
            }
        }
    }