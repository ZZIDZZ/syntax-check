private function pluginHooks()
    {
        if (!is_array(self::$activated)) {
            return;
        }

        foreach (self::$activated as $plugin_file => $plugin_info) {
            add_action('wp_loaded', function () use ($plugin_file) {
                do_action('activate_' . $plugin_file);
            });
        }
    }