private function getValueName(string $name): ?string
    {
        if (array_key_exists($name, $this->values)) {
            return $name;
        }

        //It's a localizable field
        $language = $this->table->getDatabase()->getConfig(Database::CONFIG_LOCALE);

        if (!is_null($language)) {
            $name .= "_{$language}";

            if (array_key_exists($name, $this->values)) {
                return $name;
            }
        }

        return null;
    }