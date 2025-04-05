private function setLocale($locale)
    {
        // Check if is allowed and set default locale if not
        if (!language()->allowed($locale)) {
            $locale = config('app.locale');
        }

        // Set app language
        \App::setLocale($locale);

        // Set carbon language
        if (config('language.carbon')) {
            // Carbon uses only language code
            if (config('language.mode.code') == 'long') {
                $locale = explode('-', $locale)[0];
            }

            \Carbon\Carbon::setLocale($locale);
        }

        // Set date language
        if (config('language.date')) {
            // Date uses only language code
            if (config('language.mode.code') == 'long') {
                $locale = explode('-', $locale)[0];
            }

            \Date::setLocale($locale);
        }
    }