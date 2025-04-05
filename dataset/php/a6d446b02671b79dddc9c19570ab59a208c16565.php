public function render($path, $data = [])
    {
        $this->data = array_merge($this->data, $data);
        $this->setPath($path);
        $contents = $this->renderContents();

        return $contents;
    }