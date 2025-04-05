public function watch($enable = true, $format = 'json'){
        if($enable){
            fwrite($this->stream, '?WATCH={"enable":true,"'.$format.'":true}');
        }else{
            fwrite($this->stream, '?WATCH={"enable":false}');
        }
    }