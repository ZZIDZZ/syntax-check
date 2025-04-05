protected function getValidErrors($firstOfAll = false)
    {
        return $firstOfAll ? $this->getValidation()->errors()->firstOfAll() : $this->getValidation()->errors();
    }