private function mergeJobValues(array $preRequestValues, array $postRequestValues)
    {
        $result = array_map(function (Value $postValue) use ($preRequestValues) {
            $preValues = array_filter($preRequestValues, function (Value $preValue) use ($postValue) {
                return $postValue->getExternalId() === $preValue->getExternalId();
            });

            /** @var Value $preValue */
            $preValue = $preValues[0];

            $postValue
                ->setTemplateVariables($preValue->getTemplateVariables())
                ->setTitle($preValue->getTitle())
            ;

            return $postValue;
        }, $postRequestValues);

        return $result;
    }