protected function makeLocaleRoutesPath($locale, $localeKeys)
    {
        $path = $this->getDefaultCachedRoutePath();

        $localeSegment = request()->segment(1);
        if ( ! $localeSegment || ! in_array($localeSegment, $localeKeys)) {
            return $path;
        }

        return substr($path, 0, -4) . '_' . $locale . '.php';
    }