public function validate($value, Constraint $constraint)
    {
        $method = $constraint->method;
        if (!$this->getManager()->$method($value, $constraint)) {
            $this->setMessage($constraint->message, array(
                '%property%' => $constraint->property
            ));
            return false;
        }

        return true;
    }