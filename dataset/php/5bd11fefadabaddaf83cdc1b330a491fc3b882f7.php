protected function getValidator(): ValidatorInterface
    {
        if ($this->validator === null) {
            $this->validator = new GreaterThanValidator(
                $this->getPriority()->getValue()
            );
        }

        return $this->validator;
    }