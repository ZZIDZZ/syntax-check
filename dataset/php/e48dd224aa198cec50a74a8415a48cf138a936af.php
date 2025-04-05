protected function getFieldError($field, $format = '<span class="help-block">:message</span>')
    {
        $field = $this->flattenFieldName($field);

        if ($this->getErrors()) {
            $allErrors = $this->config->get('html.bootstrap.show_all_errors');

            if ($this->getErrorBag()) {
                $errorBag = $this->getErrors()->{$this->getErrorBag()};
            } else {
                $errorBag = $this->getErrors();
            }

            if ($allErrors) {
                return implode('', $errorBag->get($field, $format));
            }

            return $errorBag->first($field, $format);
        }
    }