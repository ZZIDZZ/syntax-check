public function bind(string $alias, string $template, array $params = []): void {
    $this->bindCallback($alias, function(Generator $generator) use($template, $params): void {
      $compiled = $generator->generate($template, $params);
      $generator->includeFile($compiled);
    });
  }