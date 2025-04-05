protected function parseLess($basePath, $asset, $result)
    {
        $parser = new \Less_Parser([
            'compress' => ($this->compress === true) ? true : false,
            'cache_dir' => ($this->useCache === true) ? ($this->cacheDir !== null && is_dir($this->cacheDir)) ? $this->cacheDir : __DIR__ . DIRECTORY_SEPARATOR . 'cache' : false,
        ]);

        $parser->parseFile($basePath . DIRECTORY_SEPARATOR . $asset);

        if ((!$css = $parser->getCss()) || empty($css))
            return false;

        Yii::trace("Converted $asset into $result", __METHOD__);

        return file_put_contents($basePath . DIRECTORY_SEPARATOR . $result, $css, LOCK_EX);
    }