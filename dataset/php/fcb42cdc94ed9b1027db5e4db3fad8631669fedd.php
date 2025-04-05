public function divide(Number $multiplicator)
    {
        $resultDecimalValue = round($this->decimalValue() / $multiplicator->decimalValue(), 0);

        $result = new Number($resultDecimalValue);

        return $result->convert($this->getNumberSystem());
    }