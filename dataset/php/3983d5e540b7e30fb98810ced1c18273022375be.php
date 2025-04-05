private function isValidDate($date){
        return preg_match('#[0-3][0-9]\/[0-1][0-9]\/[2][0][0-9][0-9]#', $date)
               &&
               checkdate((int)substr($date, 3, 2),
                         (int)substr($date, 0, 2),
                         (int)substr($date, 6, 4));
    }