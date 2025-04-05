public function notices($context = null)
    {
         $notices = [];

        // fallback to the CMS as the context - this is required to be consistent with the original behaviour.
        if ($context == null || $context instanceof HTTPRequest) {
            $context = 'CMS';
        }

        // We want to deliver notices only if a user is logged in.
        // This way we ensure, that a potential attacker can't read notices for CMS users.
        if (Member::currentUser()) {
            $notices = TimedNotice::get_notices($context)->toNestedArray();
        }

        return Convert::array2json($notices);
    }