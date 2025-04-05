public function renderView($template)
    {
        if (array_key_exists($template, $this->views)) {
            echo $this->views[$template]->render();
            return false;
        }

        return $template;
    }