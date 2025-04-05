public static function obfuscate(?int $id, string $alias): ?string
  {
    return self::$obfuscatorFactory->encode($id, $alias);
  }