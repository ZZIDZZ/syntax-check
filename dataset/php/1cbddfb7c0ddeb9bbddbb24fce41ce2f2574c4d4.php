protected function validateData($data)
    {
        $data = $this->replaceAttributes($data);

        foreach ($this->required as $required) {
            if (! array_key_exists($required, $data)) {
                $replacement = array_search($required, $this->replacements);

                if ($replacement !== false) {
                    $required = $replacement;
                }

                throw new \InvalidArgumentException("Required sitemap property [$required] is not present.");
            }
        }
    }