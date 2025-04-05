public function calculate(FormulasInterface $formula): Calculator
    {
        $formula
            ->using($this->dataSet)
            ->knowing($this->results)
            ->calculate();

        $this->results->save($formula);

        return $this;
    }