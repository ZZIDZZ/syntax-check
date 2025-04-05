public function validate(NonceContextInterface $context = null)
    {
        $context or $context = new RequestGlobalsContext();

        $value = $context->offsetExists($this->action) ? $context[$this->action] : '';
        if (!$value || !is_string($value)) {
            return false;
        }

        $lifeFilter = $this->lifeFilter();

        add_filter('nonce_life', $lifeFilter);
        $valid = wp_verify_nonce($value, $this->hashedAction());
        remove_filter('nonce_life', $lifeFilter);

        return (bool)$valid;
    }