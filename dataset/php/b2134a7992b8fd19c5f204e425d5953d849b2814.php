protected function generateMinifyList($list, $exclude) {
        $pendingList = array();
        $pendingParameters = false;
        $resultList = array();

        foreach ($list as $url=>$parameters) {
            if(preg_match('#^https?\://#', $url) || in_array($url, $this->$exclude) ) {
                // for absolute or exculded url, we put directly in the result
                // we won't try to minify it or combine it with an other file
                $resultList[$url] = $parameters;
                continue;
            }
            ksort($parameters);
            if ($pendingParameters === false) {
                $pendingParameters = $parameters;
                $pendingList[] = $url;
                continue;
            }
            if ($pendingParameters == $parameters) {
                $pendingList[] = $url;
            }
            else {
                $resultList[$this->generateMinifyUrl($pendingList)] = $pendingParameters;
                $pendingList = array($url);
                $pendingParameters = $parameters;
            }
        }
        if ($pendingParameters !== false && count($pendingList)) {
            $resultList[$this->generateMinifyUrl($pendingList)] = $pendingParameters;
        }
        return $resultList;
    }