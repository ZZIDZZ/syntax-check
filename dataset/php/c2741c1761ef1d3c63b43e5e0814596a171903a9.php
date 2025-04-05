protected function translate($constellation, $lang = 'en'): string
    {
        $arr = $this->loadTranslation($lang);

        return isset($arr[$constellation]) ? $arr[$constellation] : '';
    }