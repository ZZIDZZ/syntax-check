protected function getSettings(): array {
    $configurationManager = $this->objectManager->get(ConfigurationManagerInterface::class);
    $configuration        = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);

    return $configuration['plugin.']['tx_t3vcontent.']['settings.'];
  }