public function verify()
    {
        $sServerKey = appSetting('site_key_server', 'nails/driver-captcha-recaptcha');

        if ($sServerKey) {

            $oHttpClient = Factory::factory('HttpClient');
            $oInput      = Factory::service('Input');

            try {

                $oResponse = $oHttpClient->post(
                    'https://www.google.com/recaptcha/api/siteverify',
                    [
                        'form_params' => [
                            'secret'   => $sServerKey,
                            'response' => $oInput->post('g-recaptcha-response'),
                            'remoteip' => $oInput->ipAddress(),
                        ],
                    ]
                );

                if ($oResponse->getStatusCode() !== 200) {
                    throw new CaptchaDriverException('Google returned a non 200 response.');
                }

                $oResponse = json_decode((string) $oResponse->getBody());

                if (empty($oResponse->success)) {
                    throw new CaptchaDriverException('Google returned an unsuccessful response.');
                }

                return true;

            } catch (\Exception $e) {
                return false;
            }

        } else {
            return false;
        }
    }