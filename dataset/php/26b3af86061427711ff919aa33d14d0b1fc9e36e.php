public function saveMap($content)
    {
        $asset_handler = Requirements::backend()->getAssetHandler();

        $css_file = $this->options['sourceMapWriteTo'];
        $asset_handler->setContent($css_file, $content);
        $url = $asset_handler->getContentURL($css_file);

        $this->options['sourceMapURL'] = $url;
        return $this->options['sourceMapURL'];
    }