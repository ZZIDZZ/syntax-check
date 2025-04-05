public static function createGuzzle()
    {
        $client = null;
        if (!class_exists(Client::class)) {
            @trigger_error('The function "HttpClientFactory::createGuzzle" is depcrecated and will be removed in 2.0.', E_USER_DEPRECATED);
            throw new \LogicException('Can not use "HttpClientFactory::createGuzzle" since Guzzle is not installed. This function is deprecated and will be removed in 2.0.');
        }

        $version = \GuzzleHttp\ClientInterface::VERSION;
        if (substr($version, 0, 1) !== '6') {
            throw new \LogicException('This version of Guzzle is not supported.');
        }

        $curl = curl_version();

        $curlOptions = [
             CURLOPT_USERAGENT => sprintf('Payum/1.x curl/%s PHP/%s', $curl['version'], phpversion()),
         ];

        return new \GuzzleHttp\Client([
             'curl' => $curlOptions,
         ]);
    }