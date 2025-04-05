public function getConfig()
    {
        $provider = new ConfigProvider();

        $this->config = $provider->getTemplateConfig();
        $this->config['middleware_pipeline']    = $provider->getMiddlewareConfig();
        $this->config['service_manager']        = $provider->getDependencyConfig();
        $this->config['router']['routes']       = $provider->getRouteConfig();
        $this->config['navigation']             = $provider->getNavigationConfig();
        $this->config['controllers']            = $provider->getControllerConfig();
        $this->config['controller_plugins']     = $provider->getControllerPluginConfig();

        // Overrides the default config to use Glob module config
        return array_merge_recursive($this->config, $provider->getGlobConfig());
    }