public function render()
    {
        if (!file_exists($this->template)):
            throw new \Exception("Template of section is not defined.");
        endif;

        $func = $this->closedRender($this->template, $this->data);
        $func();
    }