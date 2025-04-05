public function distance(LocationInterface $location, $method = 'default') {

    if (!isset($this->distanceCache[$method])) {

      if (!isset($this->distanceMethods[$method])) {
        throw new Exception('Distance method not registered.');
      }
      elseif (!class_exists($this->distanceMethods[$method])) {
        throw new Exception('The class associated with the name does not exist.');
      }

      // @todo: Should this verify the proper interface is implemented? If not
      // it will simply explode.

      $this->distanceCache[$method] = new $this->distanceMethods[$method];
    }

    return $this->distanceCache[$method]->distance($this, $location);
  }