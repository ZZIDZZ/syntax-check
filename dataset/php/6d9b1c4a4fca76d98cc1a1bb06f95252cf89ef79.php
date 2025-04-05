public function create($elementName, Project $project, $creatingClass) {
    $typedefs = $project->getDataTypeDefinitions();
    if(array_key_exists($elementName, $typedefs) && class_exists($typedefs[$elementName])) {
      $object = new $typedefs[$elementName];
      foreach($this->getAfterCreationCallbacksForClass($creatingClass) as $callback) {
        call_user_func($callback, $object, $elementName);
      }
      return $object;
    }
    throw new MissingConfigurationException(sprintf('No class or class definition found for %s', $elementName) . PHP_EOL . sprintf('Defintions: %s', print_r($typedefs)));
  }