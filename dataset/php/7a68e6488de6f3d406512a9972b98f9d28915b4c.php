function execute() {
        $data_to_post = array(
            'apikey'  => $this->apikey,
            'command' => $this->command,
            'params'  => json_encode($this->params)
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, PayPro::$apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_to_post);
        curl_setopt($ch, CURLOPT_CAINFO, $this->caBundleFile());

        $body = curl_exec($ch);

        if ($body === false) {
            $errno = curl_errno($ch);
            $message = curl_error($ch);

            curl_close($ch);

            $msg = "Could not connect to the PayPro API - [errno: $errno]: $message";
            throw new Error\Connection($msg);
        }

        curl_close($ch);

        $decodedResponse = json_decode($body, true); 

        if (is_null($decodedResponse)) {
            $msg = "The API request returned an error or is invalid: $body";
            throw new Error\InvalidResponse($msg);
        }
        
        $params = array();
        return $decodedResponse;
    }