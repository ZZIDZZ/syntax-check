public function onShell(): bool {
    $check = true;
    if (PHP_SAPI != Environment::SERVER_CLI) {
      $check = false;
    }
    return $check;
  }