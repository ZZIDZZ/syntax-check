protected function addControllerArgument($required = InputArgument::REQUIRED) : void
    {
        $controller = new InputArgument('controller', $required, 'Controller name is required');
        $this->getDefinition()->addArgument($controller);
    }