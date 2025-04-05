public function ping()
  {
    $command = $this->client->getCommand('Ping');
    $res = $this->execute($command);
    return $res;
  }