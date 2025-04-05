public function add(string $slug, string $message = '', $data = null)
    {
        $slug = $slug ?: $this->default_slug;

        if (!$message && $slug === $this->default_slug) {
            $message = $this->default_message;
        } elseif (!$message) { // If empty, base it on slug.
            $message = mb_strtolower($this->c::slugToName($slug));
            $message = $this->c::mbUcFirst($message).'.';
        }
        $this->errors[$slug][] = $message;

        if (isset($data) || !array_key_exists($slug, $this->error_data)) {
            $this->error_data[$slug] = $data;
        }
    }