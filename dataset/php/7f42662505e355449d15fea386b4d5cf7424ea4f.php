public function getHash()
    {
        $paramString = $this->getParamString(func_get_args());
        $encrypted = crypt($paramString, '$2a$07$'.$this->secret.'$');
        //echo "encrypted=$encrypted ; paramString=$paramString";
        return $encrypted;
    }