protected function _translate(array $list)
    {
        $domain = $this->getConfig('translationDomain');

        return array_map(function ($value) use ($domain) {
            return __d($domain, $value);
        }, $list);
    }