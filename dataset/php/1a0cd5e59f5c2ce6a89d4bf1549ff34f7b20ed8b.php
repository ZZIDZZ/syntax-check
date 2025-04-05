public static function availableProviders()
    {
        $settings = Settings::first();

        return collect(static::providers())->filter(function ($value) use ($settings) {
            $ci = $value.'_client_id';
            $cs = $value.'_client_secret';

            return $settings->$ci && $settings->$cs;
        })->toArray();
    }