protected function convertToSeconds($expires)
    {
        $seconds = 0;
        
        if (isset($expires['seconds'])) {
            $seconds += $expires['seconds'];
        }
        
        if (isset($expires['minutes'])) {
            $seconds += $expires['minutes'] * 60;
        }
        
        if (isset($expires['hours'])) {
            $seconds += $expires['hours'] * 60 * 60;
        }
        
        if (isset($expires['days'])) {
            $seconds += $expires['days'] * 24 * 60 * 60;
        }
        
        if (isset($expires['weeks'])) {
            $seconds += $expires['weeks'] * 7 * 24 * 60 * 60;
        }
        
        if (isset($expires['months'])) {
            $seconds += $expires['months'] * 30 * 7 * 24 * 60 * 60;
        }
        
        if (isset($expires['years'])) {
            $seconds += $expires['years'] * 365 * 30 * 7 * 24 * 60 * 60;
        }
        
        return $seconds;
    }