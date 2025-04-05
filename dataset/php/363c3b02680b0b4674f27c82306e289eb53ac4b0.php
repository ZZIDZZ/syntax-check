protected function setFlash($type,$message,$parameters = array(),$domain = 'flashes')
    {
        return $this->get('session')->getBag('flashes')->add($type,$this->trans($message, $parameters, $domain));
    }