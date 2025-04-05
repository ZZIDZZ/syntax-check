public function resolveRelativeUrl($url) {

        try {

            // return absolute url
            return new static($url);
        }
        catch(UrlException $exception) {}

        // anchor
        if($url[0] === '#') {

            return new static($this->getUrl(self::ALL - self::FRAGMENT) . $url);
        }

        // query
        if($url[0] === '?') {

            return new static($this->getUrl(self::ALL - self::FRAGMENT - self::QUERY) . $url);
        }

        // relative path from domain root
        if($url[0] === '/') {

            return new static($this->getUrl(self::ALL - self::FRAGMENT - self::QUERY - self::PATH) . substr($url, 1));
        }

        // relative path from current path
        else {

            $currentPath = $this->path ?: '/';

            // cut last path fragment
            if(substr($currentPath, -1) !== '/') {

                $currentPath = substr($currentPath, 0, strrpos($currentPath, '/') + 1);
            }

            return new static($this->getUrl(self::ALL - self::FRAGMENT - self::QUERY - self::PATH) . $this->getCanonicalizedPath($currentPath . $url));
        }
    }