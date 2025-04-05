public function injectSettings(array $settings)
    {
        $this->settings = $settings;
        if (!isset($settings['enabledDrivers'])) {
            // FIXME: This is a hotfix and should actually be fixed in the Neos setup step. As soon as it is fixed there, this condition can be removed.
            return;
        }
        if (!in_array($settings['driver'], array_keys(array_filter($settings['enabledDrivers'])), true)) {
            throw new \InvalidArgumentException('The "driver" for Imagine must be enabled by settings, check Neos.Imagine.enabledDrivers.', 1515402616);
        }
    }