public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
        StaticProxy::setContainer($this->container);

        return $this;
    }