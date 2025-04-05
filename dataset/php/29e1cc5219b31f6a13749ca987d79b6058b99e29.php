public function calculate($expression)
    {
        $translatedExpression = $this->translate($expression);
        $result = eval('return '.$translatedExpression.';');

        $decimalResult = new Number($result); // this is bad and needs some work

        return $decimalResult->convert($this->numberSystem);
    }