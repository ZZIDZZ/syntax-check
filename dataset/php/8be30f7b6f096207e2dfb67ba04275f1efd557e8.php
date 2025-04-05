protected function buildConfiguration($strategy, $strategyConfig)
    {
        $config = array_merge($this->callParams, array(
            'path' => rtrim($this->router->generate('dcs_opauth_connect'), '/').'/',
            'callback_url' => $this->router->generate('dcs_opauth_response', array(
                'strategy' => $strategy,
            )),
            'security_salt' => uniqid(null, true),
        ));

        if (isset($strategyConfig['options']) && is_array($strategyConfig['options'])) {
            $strategyConfig = array_merge($strategyConfig, $strategyConfig['options']);
            unset($strategyConfig['options']);
        }

        $config['Strategy'][$strategy] = $strategyConfig;

        return $config;
    }