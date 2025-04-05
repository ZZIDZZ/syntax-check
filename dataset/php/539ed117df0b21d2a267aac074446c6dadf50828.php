private function getControllerAction($attribute)
    {
        return is_array($attribute)
            ? $this->url->action($attribute[0], array_slice($attribute, 1))
            : $this->url->action($attribute);
    }