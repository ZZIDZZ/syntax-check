public function initializeLayout(\PageModel $page, \LayoutModel $layout): void
    {
        $environment = $this->environment;
        $environment->setLayout($layout);
        $environment->setEnabled($layout->layoutType == 'bootstrap');

        $event = new InitializeLayout($environment, $layout, $page);
        $this->eventDispatcher->dispatch($event::NAME, $event);
    }