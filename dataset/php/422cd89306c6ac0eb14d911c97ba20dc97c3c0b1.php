public function offsetSet($offset, $module)
    {
        if (!$module instanceof ModuleInterface) {
            throw new RuntimeException(
                sprintf('ModuleManager::offsetSet() expects "%s" to be an instance of ModuleInterface.', $module)
            );
        }

        $newModule = [
            'object' => $module,
            'loaded' => time(),
            'plugin' => false,
            'pluginName' => '',
            'pluginPath' => MODULE_DIR,
            'name' => get_class($module),
            'modified' => false
        ];

        if (in_array($offset, $this->priorityList)) {
            $temp = array_reverse($this->loadedModules, true);
            $temp[$offset] = $newModule;
            $this->loadedModules = array_reverse($temp, true);
        } else {
            $this->loadedModules[$offset] = $newModule;
        }
    }