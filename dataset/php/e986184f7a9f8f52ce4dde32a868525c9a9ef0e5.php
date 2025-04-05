private function WillFollowRedirects()
    {
        $open_basedir = ini_get('open_basedir');
        $safe_mode = strtolower(ini_get('safe_mode'));
        if (empty($open_basedir) && $safe_mode == 'off') {
            return true;
        }
        return false;
    }