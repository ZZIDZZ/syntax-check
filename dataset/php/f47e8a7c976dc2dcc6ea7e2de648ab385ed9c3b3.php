public function glyphIcon($glyphIcon)
    {
        if (empty($this->parts['{input}'])) {
            throw new InternalErrorException('Firstly you must set field type!');
        }

        if (empty($glyphIcon) || !$this->_glyphIconAllowed) {
            $this->parts['{glyphIcon}'] = '';
            return $this;
        }

        $this->parts['{glyphIcon}'] = Html::tag('span', '', ['class' => "glyphicon glyphicon-$glyphIcon form-control-feedback"]);

        return $this;
    }