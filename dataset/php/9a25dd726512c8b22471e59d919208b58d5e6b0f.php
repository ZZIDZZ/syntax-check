public function log($value = null)
    {
        $log = (is_numeric($value)) ? static::$logs[$this->id][$value] : end(static::$logs[$this->id]);
        if (isset($log['errors'])) {
            $log['errors'] = array_count_values($log['errors']);
        }
        $log['average'] = ($log['count'] > 0) ? $log['executed'] / $log['count'] : 0;
        $log['total'] = $log['prepared'] + $log['executed'];
        $log['time'] = round($log['total'] * 1000).' ms';
        if ($log['count'] > 1) {
            $log['time'] .= ' (~'.round($log['average'] * 1000).' ea)';
        }
        if (is_null($value) || is_numeric($value)) {
            return $log;
        }

        return (isset($log[$value])) ? $log[$value] : null;
    }