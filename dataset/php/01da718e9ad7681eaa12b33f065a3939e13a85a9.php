public function getRequestUri(): string
  {
    if (isset($_SERVER['REQUEST_URI']))
    {
      $requestUri = $_SERVER['REQUEST_URI'];
      if ($requestUri!=='' && $requestUri[0]!=='/')
      {
        $requestUri = preg_replace('/^(http|https):\/\/[^\/]+/i', '', $requestUri);
      }

      return $requestUri;
    }

    throw new \LogicException('Unable to resolve requested URI');
  }