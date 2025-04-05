public function setFakeFrom($name, $email)
    {
        $this->fakeFromName = $name;
        $this->fakeFromEmail = $email;
        return $this;
    }