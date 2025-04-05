public function getActiveUserHashedEmail()
    {
        $email = null;
        if ($this->isLoaded()) {
            $email = md5($this->user->oxuser__oxusername->value);
        }

        return $email;
    }