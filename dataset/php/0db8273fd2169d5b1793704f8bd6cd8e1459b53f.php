public function init()
    {
        // Get default root, uri and binary from project.
        $this->root = $this->getProject()->getProperty('drush.root');
        $this->uri = $this->getProject()->getProperty('drush.uri');
        $this->bin = $this->getProject()->getProperty('drush.bin');
        $this->dir = $this->getProject()->getProperty('drush.dir');
        $this->alias = $this->getProject()->getProperty('drush.alias');
        $this->setVerbose($this->getProject()->getProperty('drush.verbose'));
        $this->setAssume($this->getProject()->getProperty('drush.assume'));
        $this->setPassthru($this->getProject()->getProperty('drush.passthru'));
        $this->setLogOutput($this->getProject()->getProperty('drush.logoutput'));
    }