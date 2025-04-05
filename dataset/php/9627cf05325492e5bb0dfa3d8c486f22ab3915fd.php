public function getToken($code)
    {
        if (!$this->guzzle) {
            $this->guzzle = new \GuzzleHttp\Client();
        }

        $uri = sprintf(
            self::URL_ACCESS_TOKEN,
            $this->g('client_id'),
            $this->g('client_secret'),
            $code,
            urlencode($this->g('redirect_uri'))
        );

        $data = $this->guzzle->get($uri)->getBody();
        $data = json_decode($data);

        if (isset($data->access_token)) {
            return new \getjump\Vk\Response\Auth($data->access_token, $data->expires_in, $data->user_id);
        } elseif (isset($data->error)) {
            // ERROR PROCESSING
        }

        return false;
    }