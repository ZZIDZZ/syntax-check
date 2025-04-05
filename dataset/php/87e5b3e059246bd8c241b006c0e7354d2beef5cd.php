private function manageSize()
  {
    $overflow = count($this->element_queue) - $this->maxsize;
    if ($overflow > 0) {
        foreach (array_slice($this->element_queue, 0, $overflow) as $name) {
          if ($this->cache->has($name)) {
            $this->cache->delete($name);
          }
        }
        $this->element_queue = array_slice($this->element_queue, $overflow);
    }
  }