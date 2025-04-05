public function &addError($error, $field = self::ANY_FIELD)
    {
        if (empty($field)) {
            $field = self::ANY_FIELD;
        }

        if (empty($this->errors[$field])) {
            $this->errors[$field] = [];
        }

        $this->errors[$field][] = $error;

        return $this;
    }