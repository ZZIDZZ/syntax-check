private function readProxyType($pointer) {
    if (false === $pointer) {
      // Deal with invalid IPs
      $proxyType = self::INVALID_IP_ADDRESS;
    } elseif (0 === self::$columns[self::PROXY_TYPE][$this->type]) {
      // If the field is not suported, return accordingly
      $proxyType = self::FIELD_NOT_SUPPORTED;
    } else {
      // Read proxy type
      $proxyType = $this->readString($pointer + self::$columns[self::PROXY_TYPE][$this->type]);
    }
    return $proxyType;
  }