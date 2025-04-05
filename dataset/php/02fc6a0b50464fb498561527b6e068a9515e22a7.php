protected function getRootMenu(BlockContextInterface $blockContext)
    {
        $settings = $blockContext->getSettings();
        /*
         * @todo : Use the router to get the homepage URI
         */

        $menu = $this->factory->createItem('breadcrumb');

        $menu->setChildrenAttribute('class', 'breadcrumb');

        if (method_exists($menu, 'setCurrentUri')) {
            $menu->setCurrentUri($settings['current_uri']);
        }

        if (method_exists($menu, 'setCurrent')) {
            $menu->setCurrent($settings['current_uri']);
        }

        if ($settings['include_homepage_link']) {
            $menu->addChild('sonata_seo_homepage_breadcrumb', ['uri' => '/']);
        }

        return $menu;
    }