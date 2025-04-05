public function resolve(string $file)
    {
        if (!$this->sorted)
            $this->sortModules();

        $file = ltrim($file, '/');
        if ($this->ext !== null && substr($file, -strlen($this->ext)) !== $this->ext)
            $file .= $this->ext;

        $cache = $this->getCachedData();
        $cached = $cache !== null ? $cache->get('data', $file) : null;

        if ($cached === false && $this->authorative)
            return null;

        if (!empty($cached))
        {
            if (file_exists($cached['path']) && is_readable($cached['path']))
            {
                self::$logger->debug(
                    "Resolved {0} {1} to path {2} (module: {3}) (cached)", 
                    [$this->name, $file, $cached['path'], $cached['module']]
                );
                return $cached['path'];
            }
            else
            {
                self::$logger->error(
                    "Cached path for {0} {1} from module {2} cannot be read: {3}", 
                    [$this->name, $file, $cached['module'], $cached['path']]
                );
            }
        }

        $path = null;
        $found_module = null;
        $mods = $this->search_path;

        foreach ($mods as $module => $info)
        {
            $location = $info['path'];
            self::$logger->debug("Trying {0} path: {1}/{2}", [$location, $this->name, $file]);
            $path = $location . '/' . $file;

            if (file_exists($path) && is_readable($path))
            {
                $found_module = $module;
                break;
            }
        }

        if ($found_module !== null)
        {
            self::$logger->debug("Resolved {0} {1} to path {2} (module: {3})", [$this->name, $file, $path, $found_module]);
            if ($cache !== null)
            {
                $cache->set(
                    'data',
                    $file, 
                    array("module" => $found_module, "path" => $path)
                );
            }
            return $path;
        }
        elseif ($cache !== null)
        {
            $cache->set('data', $file, false);
        }
    
        return null;
    }