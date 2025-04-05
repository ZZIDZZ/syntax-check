private function getRelationName(string $range): string
    {
        $class = $this->classes[$range];

        if (isset($class['interfaceName'])) {
            return $class['interfaceName'];
        }

        if (isset($this->config['types'][$class['name']]['namespaces']['class'])) {
            return sprintf('%s\\%s', $this->config['types'][$class['name']]['namespaces']['class'], $class['name']);
        }

        if (isset($this->config['namespaces']['entity'])) {
            return sprintf('%s\\%s', $this->config['namespaces']['entity'], $class['name']);
        }

        return $class['name'];
    }