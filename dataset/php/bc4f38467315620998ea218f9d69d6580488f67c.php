public function handle(BuildMetaModelOperationsEvent $event)
    {
        foreach ($event->getMetaModel()->getAttributes() as $attribute) {
            if (($attribute instanceof TranslatedCheckbox) && ($attribute->get('check_publish') == 1)) {
                $container = $event->getContainer();
                if ($container->hasDefinition(Contao2BackendViewDefinitionInterface::NAME)) {
                    $view = $container->getDefinition(Contao2BackendViewDefinitionInterface::NAME);
                } else {
                    $view = new Contao2BackendViewDefinition();
                    $container->setDefinition(Contao2BackendViewDefinitionInterface::NAME, $view);
                }
                $this->buildCommandsFor($attribute, $view->getModelCommands());
            }
        }
    }