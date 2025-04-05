public function replace(Text $text, Text $replace): Text {
    return new Text(preg_replace($this->raw, $replace->raw, $text->raw));
  }