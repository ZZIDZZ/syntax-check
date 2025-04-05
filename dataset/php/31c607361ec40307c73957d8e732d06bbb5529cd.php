protected function addEnvVarsToApp(Container $app)
    {
        $hasPrefix = function ($elem) use ($app) {
            return strpos($elem, $app['env.options']['prefix'].'_') !== false;
        };
        $arrayFilterKeys = function ($input, $callback) {
            if (!is_array($input)) {
                trigger_error(
                    'array_filter_key() expects parameter 1 to be array, '.gettype($input).' given',
                    E_USER_WARNING
                );

                return null;
            }

            if (empty($input)) {
                return $input;
            }

            $filteredKeys = array_filter(array_keys($input), $callback);
            if (empty($filteredKeys)) {
                return array();
            }

            $input = array_intersect_key(array_flip($filteredKeys), $input);

            return $input;
        };

        $envVars = $arrayFilterKeys($_ENV, $hasPrefix);
        $envVars = array_merge($arrayFilterKeys($_SERVER, $hasPrefix), $envVars);
        foreach ($envVars as $envVar => $empty) {
            $var = \Dotenv::findEnvironmentVariable($envVar);
            if ($var) {
                $key = strtolower(str_replace($app['env.options']['prefix'].'_', '', $envVar));
                $app[$key] = $var;
            }
        }
    }