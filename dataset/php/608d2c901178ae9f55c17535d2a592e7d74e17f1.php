protected function hideAdminNag()
    {
        if (!function_exists("remove_action")) {
            return;
        }

        /**
         * Hide maintenance and update nag
         */
        $this->wpMockery->removeAction('admin_notices', 'update_nag', 3);
        $this->wpMockery->removeAction('network_admin_notices', 'update_nag', 3);
        $this->wpMockery->removeAction('admin_notices', 'maintenance_nag');
        $this->wpMockery->removeAction('network_admin_notices', 'maintenance_nag');

        $this->wpMockery->removeAction('wp_maybe_auto_update', 'wp_maybe_auto_update');
        $this->wpMockery->removeAction('admin_init', 'wp_maybe_auto_update');
        $this->wpMockery->removeAction('admin_init', 'wp_auto_update_core');

        $this->wpMockery->wpClearScheduledHook('wp_maybe_auto_update');
    }