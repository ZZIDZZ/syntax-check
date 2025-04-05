public function reverseColors() {

        // switch them
        $text = $this->textColor;
        $this->textColor = $this->fillColor;
        $this->fillColor = $text;

        return $this;
    }