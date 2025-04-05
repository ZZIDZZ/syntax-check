public function addContent($content = null)
    {
        if (!is_null($content)) {
            $htmlElementObject = new HtmlElementContent($content);
            $this->getChildElementCollection()->add($htmlElementObject);
        }
        return $this;
    }