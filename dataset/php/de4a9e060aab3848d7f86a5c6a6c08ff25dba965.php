public function getAddressLines()
    {
        return array_filter([
            $this->getComplex(),
            implode(' ', array_filter([$this->getStreetNumber(), $this->getStreetName()])),
            $this->getSuburb(),
            $this->getCity(),
            $this->getPostalCode()
        ]);
    }