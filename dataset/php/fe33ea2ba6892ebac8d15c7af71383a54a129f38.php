private static function validateSession()
    {
        if (isset($_SESSION['OBSOLETE']) && !isset($_SESSION['EXPIRES'])) {
            return false;
        }

        if (isset($_SESSION['EXPIRES']) && $_SESSION['EXPIRES'] < time()) {
            return false;
        }

        return true;
    }