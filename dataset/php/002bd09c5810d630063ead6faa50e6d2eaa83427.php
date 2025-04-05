public function toString(/*boolean*/ $includeFile = false) {
    $format = true === $includeFile
      ? '%s #%d (%s): %s in %s(%d)'
      : '%s #%d (%s): %s';
    return sprintf(
      $format,
      $this->getType(),
      $this->getCode(),
      $this->getMagic(),
      $this->getMessage(),
      $this->getFile(),
      $this->getLine()
    );
  }