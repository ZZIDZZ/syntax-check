function initSession() {

        static $initSessionCalled = false;

        if($initSessionCalled == true){
            return;
        }

        $initSessionCalled = true;
        $currentCookieParams = session_get_cookie_params();
        $domainInfo = $this->domain->getDomainInfo();

        session_set_cookie_params(
            $currentCookieParams["lifetime"],
            $currentCookieParams["path"],
            '.'.$domainInfo->rootCanonicalDomain, //leading dot according to http://www.faqs.org/rfcs/rfc2109.html
            $currentCookieParams["secure"],
            $currentCookieParams["httponly"]
        );

        session_name($this->sessionName);

        if (isset($_COOKIE[$this->sessionName])) {
            //Only start the session automatically, if the user sent us a cookie.
            $this->startSession();
        }
    }