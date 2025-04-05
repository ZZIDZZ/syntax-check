protected function hashName()
    {
        $userId = $this->app['config']->get('sendpulse.api_user_id');
        $secret = $this->app['config']->get('sendpulse.api_secret');

        return md5($userId . '::' . $secret);
    }