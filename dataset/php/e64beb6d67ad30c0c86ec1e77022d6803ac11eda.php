public function makeCache(Vars $vars)
    {
        if ($this->provide) {
            $cache_folder = sprintf("%s/vars", $this->path);
            if (!file_exists($cache_folder)) {
                mkdir($cache_folder, 0777, true);
            }

            $cache_file = sprintf('%s/%s.php', $cache_folder, $this->name);
            file_put_contents($cache_file, serialize($vars));
        }
    }