protected function generateUniqueHash()
    {
        return $this->_order->getUniqHash() ?:
            md5(sprintf("%s.%s.%s.%s.%s.%s",
                $this->getDIDExpireDateGmt(),
                $this->getOrderId(),
                $this->getDIDMappingFormat(),
                $this->getDIDPeriod(),
                $this->getDIDTimeLeft(),
                $this->getDIDNumber()
            ));
    }