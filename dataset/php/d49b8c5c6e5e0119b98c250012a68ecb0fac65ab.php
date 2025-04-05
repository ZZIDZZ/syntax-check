public static function defineFunctionMock($namespace, $name)
    {
        $functionMockBuilder = new MockBuilder();
        $functionMockBuilder->setNamespace($namespace)
                            ->setName($name)
                            ->setFunction(function () {
                            })
                            ->build()
                            ->define();
    }