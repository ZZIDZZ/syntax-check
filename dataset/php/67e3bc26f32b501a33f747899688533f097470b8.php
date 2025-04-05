protected function resolveFilePath(string $filePath): string
    {
        $localPath = $this->config->get('whoops-editor.local-projects-path');
        $homesteadPath = $this->config->get('whoops-editor.homestead-projects-path');

        if (!$localPath || !$homesteadPath) {
            return $filePath;
        }

        $local = rtrim($localPath, '/');
        $homestead = rtrim($homesteadPath, '/');

        return str_replace("{$homestead}/", "{$local}/", $filePath);
    }