public static function default(): self
    {
        return new self(
            new Factory\Header\HeadersFactory(
                Factories::default()
            ),
            new Factory\Environment\EnvironmentFactory,
            new Factory\Cookies\CookiesFactory,
            new Factory\Query\QueryFactory,
            new Factory\Form\FormFactory,
            new Factory\Files\FilesFactory
        );
    }