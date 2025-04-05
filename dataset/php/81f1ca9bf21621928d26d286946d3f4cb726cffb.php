public function jumpstart()
    {
        $this->getLoader()->action('activate_' . $this->getBasename(), array($this, 'activate'));
        $this->getLoader()->action('deactivate_' . $this->getBasename(), array($this, 'deactivate'));
        $this->getLoader()->action('uninstall_' . $this->getBasename(), array($this, 'uninstall'));
        $this->getLoader()->run();
    }