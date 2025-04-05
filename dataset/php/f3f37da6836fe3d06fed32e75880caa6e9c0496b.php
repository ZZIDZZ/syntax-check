public function download($ftkey, $size, $passthru = FALSE)
  {
    $this->init($ftkey);

    if($passthru)
    {
      return $this->passthru($size);
    }

    $buff = new \ManiaLivePlugins\Standard\TeamSpeak\TeamSpeak3\Helper\String("");
    $size = intval($size);
    $pack = 4096;

    \ManiaLivePlugins\Standard\TeamSpeak\TeamSpeak3\Helper\Signal::getInstance()->emit("filetransferDownloadStarted", $ftkey, count($buff), $size);

    for($seek = 0;$seek < $size;)
    {
      $rest = $size-$seek;
      $pack = $rest < $pack ? $rest : $pack;
      $data = $this->getTransport()->read($rest < $pack ? $rest : $pack);
      $seek = $seek+$pack;

      $buff->append($data);

      \ManiaLivePlugins\Standard\TeamSpeak\TeamSpeak3\Helper\Signal::getInstance()->emit("filetransferDownloadProgress", $ftkey, count($buff), $size);
    }

    $this->getProfiler()->stop();

    \ManiaLivePlugins\Standard\TeamSpeak\TeamSpeak3\Helper\Signal::getInstance()->emit("filetransferDownloadFinished", $ftkey, count($buff), $size);

    if(strlen($buff) != $size)
    {
      throw new FileTransfer\Exception("incomplete file download (" . count($buff) . " of " . $size . " bytes)");
    }

    return $buff;
  }