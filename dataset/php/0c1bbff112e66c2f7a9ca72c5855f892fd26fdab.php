protected function addDefaultParsers()
    {
        $this->addParser(new HtmlParser());
        $this->addParser(new YouTubeParser());
        $this->addParser(new VimeoParser());
    }