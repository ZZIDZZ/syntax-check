protected function registerTrans()
    {
        $path = base_path("resources/lang/modules/{$this->module->getName()}");

        if (is_dir($path)) {
            $this->loadTranslationsFrom($path, $this->module->getName());
        } else {
            $this->loadTranslationsFrom($this->module->getPath('resources/lang'), $this->module->getName());
        }
    }