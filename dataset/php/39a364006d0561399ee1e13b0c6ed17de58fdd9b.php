public function getOutput()
  {
    return sprintf( $this->getTemplate(), $this->getProperty(), $this->getValue(), $this->getBang() );
  }