private function request_path()
    {
        $request_uri = explode('/', trim($this->options['REQUEST_URI'], '/'));
        $script_name = explode('/', trim($this->options['SCRIPT_NAME'], '/'));
        $parts = array_diff_assoc($request_uri, $script_name);
        if (empty($parts)) {
            return '/';
        }

        $path = implode('/', $parts);
        if (($position = strpos($path, '?')) !== false) {
            $path = substr($path, 0, $position);
        }
        return $path;
    }