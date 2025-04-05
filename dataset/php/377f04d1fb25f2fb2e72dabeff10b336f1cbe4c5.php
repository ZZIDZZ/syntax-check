public function equals($nameId, $format)
    {
        if (false == $this->getSubject()) {
            return false;
        }

        if (false == $this->getSubject()->getNameID()) {
            return false;
        }

        if ($this->getSubject()->getNameID()->getValue() != $nameId) {
            return false;
        }

        if ($this->getSubject()->getNameID()->getFormat() != $format) {
            return false;
        }

        return true;
    }