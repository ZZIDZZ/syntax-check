public function urlHostInCache(PHPCrawlerURLDescriptor $URL)
  {
    $url_parts = PHPCrawlerUtils::splitURL($URL->url_rebuild);
    return $this->hostInCache($url_parts["host"]);
  }