public function forward($route, array $attributes = [], array $query = [])
    {
        return $this->getKernel()->forward($route, $attributes, $query);
    }