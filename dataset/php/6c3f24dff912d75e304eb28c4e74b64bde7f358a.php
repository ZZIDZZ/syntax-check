public function createPositionalParameter($value, $type = \PDO::PARAM_STR)
    {
        $this->boundCounter++;
        $this->setParameter($this->boundCounter, $value, $type);

        return "?";
    }