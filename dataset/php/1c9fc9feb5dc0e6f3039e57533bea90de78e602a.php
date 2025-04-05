protected function ensureUrlOrFile($input, $type = null)
    {
        if ($input instanceof File) {
            $this->_tmpFiles[] = $input;
            return $input;
        } elseif (preg_match(self::REGEX_URL, $input)) {
            return $input;
        } elseif ($type === self::TYPE_XML || $type === null && preg_match(self::REGEX_XML, $input)) {
            $ext = '.xml';
        } else {
            // First check for obvious HTML content to avoid is_file() as much
            // as possible as it can trigger open_basedir restriction warnings
            // with long strings.
            $isHtml = $type === self::TYPE_HTML || preg_match(self::REGEX_HTML, $input);
            if (!$isHtml) {
                $maxPathLen = defined('PHP_MAXPATHLEN') ?
                    constant('PHP_MAXPATHLEN') : self::MAX_PATHLEN;
                if (strlen($input) <= $maxPathLen && is_file($input)) {
                    return $input;
                }
            }
            $ext = '.html';
        }
        $file = new File($input, $ext, self::TMP_PREFIX, $this->tmpDir);
        $this->_tmpFiles[] = $file;
        return $file;
    }