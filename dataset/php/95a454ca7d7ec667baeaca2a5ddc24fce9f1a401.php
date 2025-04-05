private function resolvePath($path)
    {
        try {
            return $this->locator->locate($path, $this->webRoot);
        } catch (\InvalidArgumentException $e) {
            // happens when path is not bundle relative
            return $this->webRoot . '/' . $path;
        }
    }