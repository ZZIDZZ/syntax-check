public function getOrCreate($filename, array $conditions = array(), $function, $file = false, $actual = false)
    {
        if (!is_callable($function)) {
            throw new \InvalidArgumentException('The argument $function should be callable');
        }

        $cacheFile = $this->getCacheFile($filename, true, true);
        $data = null;

        if (!$this->check($filename, $conditions)) {
            if(file_exists($cacheFile)) {
                unlink($cacheFile);
            }

            $data = call_user_func($function, $cacheFile);

            // Test if the closure wrote the file or if it returned the data
            if (!file_exists($cacheFile)) {
                $this->set($filename, $data);
            } else {
                $data = file_get_contents($cacheFile);
            }
        }

        return $file ? $this->getCacheFile($filename, $actual) : file_get_contents($cacheFile);
    }