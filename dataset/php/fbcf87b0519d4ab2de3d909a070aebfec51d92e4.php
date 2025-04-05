public function setTranslationLang($lang)
    {
        global $translationData;
        $translationData = array();
        $file = realpath(dirname(dirname(__FILE__)) . "/etc/lang/en-" . strtolower($lang) . ".csv");
        if (file_exists($file)) {
            if (($handle = fopen($file, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if (count($data) == 2) {
                        $translationData[$data[0]] = $data[1];
                    }
                }
                fclose($handle);
            }

        }
    }