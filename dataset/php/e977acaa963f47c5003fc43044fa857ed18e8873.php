public function filter($value)
    {
        /**
         * We try to create a \DateTime according to the format
         * If the creation fails, we return the string itself
         * so it's treated by Validate\Date
         */

        $date = (is_int($value))
            ? date_create("@$value") // from timestamp
            : DateTime::createFromFormat($this->format, $value);

        // Invalid dates can show up as warnings (ie. "2007-02-99")
        // and still return a DateTime object
        $errors = DateTime::getLastErrors();

        if ($errors['warning_count'] > 0 || $date === false) {
            return $value;
        }

        return $date;
    }