protected function parseRegexRoute($requestUri, $resource)
    {
        $route = preg_replace_callback(self::REGVAL, function ($matches) {
            $patterns = $this->patterns;
            $matches[0] = str_replace(['{', '}'], '', $matches[0]);
            if (in_array($matches[0], array_keys($patterns))) {
                return  $patterns[$matches[0]];
            }
        }, $resource);

        $regUri = explode('/', $resource);
        $args = array_diff(
              array_replace(
                  $regUri,
              explode('/', $requestUri)
            ),
            $regUri
          );

        return [array_values($args), $resource, $route];
    }