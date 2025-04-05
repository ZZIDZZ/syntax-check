private function setMailConfig()
    {
        try {
            config([
                'mail.host' => setting()->get('mail.mail_host', ''),
                'mail.port' => setting()->get('mail.mail_port', '2525'),
                'mail.username' => setting()->get('mail.mail_user', ''),
                'mail.password' => setting()->get('mail.mail_password', ''),
                'mail.from.address' => setting()->get('mail.mail_from_address', ''),
                'mail.from.name' => setting()->get('mail.mail_from_name', '')
            ]);
        } catch (\Exception $e) {}
    }