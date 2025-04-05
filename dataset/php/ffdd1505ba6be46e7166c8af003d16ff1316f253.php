public function link($name, array $params = array())
    {
        if ($this->has($name)) {
            $route = $this->routes[$name];
            $url = $route['url'];
            foreach ($params as $key => $val) {
                $url = str_replace('{'.$key.'}', $val, $url);
            }
            $url = preg_replace("/\{\w+\}/", '', $url);
            $name = ltrim(str_replace(AUTO_ROUTE, '', $url), '/');
        }

        return $this->asset($name);
    }