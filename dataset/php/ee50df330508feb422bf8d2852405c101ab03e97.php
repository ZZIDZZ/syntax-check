public function replaceMagicFields($html)
  {
    $html = str_replace('%id%', $this->getId(), $html);
    $html = str_replace('%class%', implode(' ', $this->classes), $html);
    $html = str_replace('%style%', $this->getStyle(), $html);
    $html = str_replace('%name%', $this->getName(), $html);
    $html = str_replace('%label%', $this->getLabel(), $html);

    $strAttributes = '';
    foreach ($this->attributes as $key => $value) {
      $strAttributes .= ' ' . $key . '="' . $value . '"';
    }
    $html = str_replace('%attributes%', $strAttributes, $html);
    if (!is_array($this->getValue())) {
      $html = str_replace('%value%', $this->getValue(), $html);
    }

    if (!is_array($this->getPlaceholder())) {
      $html = str_replace('%placeholder%', $this->getPlaceholder(), $html);
    }

    $html = str_replace('%error%', $this->getError(), $html);
    return $html;
  }