public function convertHeaderArrayToHeaders(array $headerArray){
         $headers = array();
         foreach($headerArray as $k => $v){
              $headers[] = $k . ":" . $v;
         }
         return $headers;
    }