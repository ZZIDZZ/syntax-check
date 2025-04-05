public function clear()
    {
        $this->_basePath = '';
        $this->_strategies = [];
        $this->_defaults = [];
        $this->_routes = [];
        $scope = $this->_classes['scope'];
        $this->_scopes = [new $scope(['router' => $this])];
    }