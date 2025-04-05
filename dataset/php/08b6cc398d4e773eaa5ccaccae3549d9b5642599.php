public function getVideos(array $options = [], $returnObject = false, $resetOptions = false)
    {
        return $this->get($options, $returnObject, $resetOptions, self::SEGMENT_VIDEOS);
    }