public function getJSONString()
    {
        $retString       = '{[DATA]}';
        $buffStringArray = array();
        foreach($this->allParameters as $param)
        {
            if(isset($this->$param))
            {
                $buffStringArray[] = "\"{$param}\":" . json_encode($this->$param);
            }
        }
        $buffString = implode(',', $buffStringArray);
        $retString  = str_replace('[DATA]', $buffString, $retString);
        return $retString;
    }