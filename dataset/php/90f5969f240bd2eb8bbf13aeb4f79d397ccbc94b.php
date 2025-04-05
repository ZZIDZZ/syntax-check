public function create($sendWelcome = true) {
        if ($this->getIsNewRecord() == false) {
            throw new \RuntimeException('Calling "' . __CLASS__ . '::' . __METHOD__ . '" on existing user');
        }

        $this->confirmed_at = time();
        $this->password = $this->password == null ? Password::generate(8) : $this->password;

        $this->trigger(self::BEFORE_CREATE);

        if (!$this->save()) {
            return false;
        }
        if($sendWelcome) {
            $this->mailer->sendWelcomeMessage($this, null, true);
        }
        $this->trigger(self::AFTER_CREATE);

        return true;
    }