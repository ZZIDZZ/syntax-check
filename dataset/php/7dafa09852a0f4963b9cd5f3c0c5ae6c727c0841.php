public function render(DocumentInterface $document, $parameters = [])
    {
        $html = $this->twig->render($this->template, [
            'doc' => $document,
            'params' => $parameters,
        ]);

        return $html;
    }