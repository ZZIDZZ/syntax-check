protected function parserHttp($http)
    {
        $response = [];

        $json = \json_decode($http, true);

        if (JSON_ERROR_NONE !== \json_last_error() || empty($http)) {
            throw new Exceptions\InvalidResponseException('Invalid response from RPC server, must be valid json.');
        }

        /**
         * Create new JsonResponse.
         *
         * @param mixed $json
         *
         * @return JsonResponse
         */
        $createJsonResponse = function ($json) {
            $id = null;
            $result = null;
            $error = [
                'code' => null,
                'message' => null,
                'data' => null,
            ];

            if (
                \is_array($json)
                & \array_key_exists('id', $json)
                & (
                    \array_key_exists('result', $json)
                    || \array_key_exists('error', $json)
                )
            ) {
                $id = $json['id'];
                $result = \array_key_exists('result', $json) ? $json['result'] : null;

                if (\array_key_exists('error', $json)) {
                    $error['code'] = \array_key_exists('code', $json['error']) ? $json['error']['code'] : null;
                    $error['message'] = \array_key_exists('message', $json['error']) ? $json['error']['message'] : null;
                    $error['data'] = \array_key_exists('data', $json['error']) ? $json['error']['data'] : null;
                }

                $response = new JsonResponse();

                $response->setId($id);
                $response->setResult($result);
                $response->setErrorCode($error['code']);
                $response->setErrorMessage($error['message']);
                $response->setErrorData($error['data']);

                return $response;
            }
            throw new Exceptions\InvalidResponseException('Invalid response format from RPC server.');
        };

        if (\array_keys($json) === \range(0, \count($json) - 1)) {
            foreach ($json as $part) {
                $response[] = $createJsonResponse($part);
            }
        } else {
            $response = $createJsonResponse($json);
        }

        return $response;
    }