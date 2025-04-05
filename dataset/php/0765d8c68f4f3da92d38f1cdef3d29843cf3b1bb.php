public function doBefore() {
        $class_name                    = get_class($this->_controller);
        $this->classAnnotations        = $this->reader->getClassAnnotations($class_name);
        $this->methodAnnotations       = $this->reader->getMethodAnnotations($class_name, $this->_controller->getAction());
    }