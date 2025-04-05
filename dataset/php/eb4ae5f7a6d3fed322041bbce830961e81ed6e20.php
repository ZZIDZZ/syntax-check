final public static function setrawcookie(
        $name, $value, $expire = 0, $path = null,
        $domain = null, $secure = false, $httponly = false
    ) {
        $cookie = new http\Cookie();
        $cookie->addCookie($name, $value);
        $cookie->setExpires($expire);
        $cookie->setPath($path);
        $cookie->setDomain($domain);
        $flags = 0;
        if ($secure) {
            $flags = Cookie::SECURE;
        }

        if ($httponly) {
            $flags = $flags | Cookie::HTTPONLY;
        }

        $cookie->setFlags($flags);
        Header::header(sprintf('Set-Cookie: %s', $cookie), false);

        return true;
    }