protected function makeLogRow(string $row)
    {
        //[2017-07-22 23:06:48]
        $date = substr($row, 1, 19);
        if (!Validator::validateDate($date)) {
            return false;
        }
        $fullMsg = substr($row, 22);
        $arrMsg = explode(":", $fullMsg);
        $logLevel = $arrMsg[0];
        $msg = substr($fullMsg, strpos($fullMsg, ":")+2);
        $out = [
            "date" => $date,
            "level" => $logLevel,
            "msg" => $msg,
        ];
        return $out;
    }