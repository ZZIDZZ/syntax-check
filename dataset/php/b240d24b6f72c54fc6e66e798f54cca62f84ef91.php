private function build($container):PhpRedisDriver
    {
        /* @var $options BernardOptions */
        $options = $container->get(BernardOptions::class);

        /* @var $instance Redis */
        $instance = $container->get($options->getRedisInstanceKey());

        return new PhpRedisDriver($instance);
    }