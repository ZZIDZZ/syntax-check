public function setParameters($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Api\SystemParameter::class);
        $this->parameters = $arr;

        return $this;
    }