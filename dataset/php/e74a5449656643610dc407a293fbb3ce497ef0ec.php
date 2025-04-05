protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        /** @var $subject Query */
        return $this->isLoggedInUser($token) || !$this->inList($subject->getName());
    }