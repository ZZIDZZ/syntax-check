protected function createException($responseArray)
    {
        if (is_array($responseArray) === false) {
            return new UnknownException(
                0,
                'Internal error',
                $responseArray['responseString']
            );
        }

        switch ($responseArray['errorCode']) {
            case -1: // Not using https:
            case -17: // Wrong HTTP-method
                return new RequestException(
                    $responseArray['errorCode'],
                    $responseArray['errorMessage'],
                    $responseArray['responseString']
                );

            case -2: // unrecognized argument
            case -3: // missing argument
            case -4: // invalid argument
            case -7: // invalid ISO Country
            case -18: // Name = Fully-Qualified Domain Name
            case -35: // Name = = IP
            case -19: // Name = = Accessible IP
                return new ArgumentException(
                    $responseArray['errorCode'],
                    $responseArray['errorMessage'],
                    ((isset($responseArray['errorItem'])) ? $responseArray['errorItem'] : null),
                    $responseArray['responseString']
                );

            case -16: // Permission denied
            case -15: // insufficient credits
                return new AccountException(
                    $responseArray['errorCode'],
                    $responseArray['errorMessage'],
                    $responseArray['responseString']
                );

            case -5: // contains wildcard
            case -6: // no wildcard, but must have
            case -8: // missing field
            case -9: // base64 decode exception
            case -10: // decode exception
            case -11: // unsupported algorithm
            case -12: // invalid signature
            case -13: // unsupported key size
            case -20: // Already rejected / Order relevated
            case -21: // Already revoked
            case -26: // current being issued
            case -40: // key compromised
                return new CSRException(
                    $responseArray['errorCode'],
                    $responseArray['errorMessage'],
                    $responseArray['responseString']
                );

            case -14:
                return new UnknownApiException(
                    $responseArray['errorCode'],
                    $responseArray['errorMessage'],
                    $responseArray['responseString']
                );

            default:
                return new UnknownException(
                    $responseArray['errorCode'],
                    $responseArray['errorMessage'],
                    $responseArray['responseString']
                );
        }
    }