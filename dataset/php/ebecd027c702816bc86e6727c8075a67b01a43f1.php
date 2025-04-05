private function addPicker(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('picker')
                    ->canBeUnset()
                    ->addDefaultsIfNotSet()
                    ->treatNullLike(array('enabled' => true))
                    ->treatTrueLike(array('enabled' => true))
                    ->children()
                        ->booleanNode('enabled')->defaultTrue()->end()
                        ->arrayNode('configs')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->enumNode('formatter')->defaultValue('js')
                                    ->values(array('js', 'php'))
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }