public function setReturnType($returnType)
    {
        if (!in_array($returnType, array(static::RETURN_OBJECT, static::RETURN_ARRAY))) {
            throw new InvalidArgumentException(sprintf('Invalid return type "%s" given.', $returnType));
        }

        $this->returnType = $returnType;

        return $this;
    }