public function getDefaultOptions(): array
    {
        return [
            'reader'                => 'file',
            'writer'                => 'file',
            'onAfterLoad'           => function(Config $config, array $options) {},
            'onBeforeSave'          => function(Config $config, array $options) {},
            'separator'             => '.',
            'templateVariables'     => [],
            'loadOptions'           => [
                'data'              => null,
                'file'              => null,
                'loadInKey'         => null,
                'processImports'    => false,
                'clearFirst'        => false,
                'readerOptions'     => []
            ]
        ];
    }