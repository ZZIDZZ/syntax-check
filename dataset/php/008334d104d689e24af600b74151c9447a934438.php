public function at(string $datestring) : void
    {
        global $argv;
        if (in_array('--all', $argv) || in_array('-a', $argv)) {
            return;
        }
        $date = date($datestring, $this->now);
        if (!preg_match("@$date$@", date('Y-m-d H:i', $this->now))) {
            throw new NotDueException;
        }
    }