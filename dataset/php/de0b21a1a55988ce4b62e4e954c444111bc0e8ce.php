public function twitter($query)
    {
        $meta = $this->queryToMeta($query);

        if (! $page = NoAPI::curl($meta['url'])) return false;

        return $this->parse($page, $meta);
    }