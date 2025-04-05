protected function getCurrentOptions()
    {
        $value = Html::getAttributeValue($this->model, $this->attribute);

        if (!isset($value) || empty($value)) {
            return [];
        }

        if (!empty($this->current)) {
            return $this->current;
        }

        if ($this->getHasId()) {
            if (!is_scalar($value)) {
                Yii::error('When Combo has ID, property $current must be set manually, or attribute value must be a scalar. Value ' . var_export($value, true) . ' is not a scalar.', __METHOD__);
                return [];
            }

            return [$value => $value];
        } else {
            if (is_array($value)) {
                return array_combine(array_values($value), array_values($value));
            }

            return [$value => $value];
        }
    }