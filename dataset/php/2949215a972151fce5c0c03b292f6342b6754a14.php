public static function postMany(array $endpoints, array $data): array
    {
        if(count($endpoints) !== count($data))
            throw new \Exception("[MVQN\REST\ResClient] ".
                "Each endpoint in a RestClient::postMany() call must have an accompanying data element.");

        // Create a cURL multi-session handler and an array to store each instance of the cURL sessions.
        $curl_handler = curl_multi_init();
        $curls = [];

        // Loop through each provided endpoint...
        for($i = 0; $i < count($endpoints); $i++)
        {
            // Create the cURL session.
            $curl = self::curl($endpoints[$i]);

            // Set any additional options.
            curl_setopt($curl, CURLOPT_POST, true);

            // Set the data to be provided to the endpoint.
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data[$i], self::JSON_OPTIONS));

            // Add the cURL session to the multi-session handler and store it in the array of sessions.
            curl_multi_add_handle($curl_handler, $curl);
            $curls[] = $curl;
        }

        $running = null;
        // Loop through and execute all of the cURL sessions in the multi-session handler...
        do curl_multi_exec($curl_handler, $running); while ($running);

        $responses = [];
        // Loop through each of the cURL sessions...
        for($i = 0; $i < count($curls); $i++)
        {
            // Get each session response and convert it to an associative array.
            $response = curl_multi_getcontent($curls[$i]);

            // Check to see if there were any errors...
            if(!$response)
                throw new \Exception("[MVQN\REST\ResClient] ".
                    "The REST request failed with the following error(s): ".curl_error($curls[$i]));

            //  Append the successful response to the array of responses.
            $responses[] = json_decode($response, true);

            // Then remove the cURL session from the multi-session handler.
            curl_multi_remove_handle($curl_handler, $curls[$i]);
        }

        // Close the cURL multi-session handler.
        curl_multi_close($curl_handler);

        // Finally, return the
        return $responses;
    }