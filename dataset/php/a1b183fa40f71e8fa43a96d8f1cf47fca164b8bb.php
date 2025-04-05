public static function build($name, $url, $isInternal, $isNewtab)
    {
        $link = new static;

        $link->title               = $name;
        $link->url                 = $url;
        $link->is_internal         = (bool) $isInternal;
        $link->is_newtab           = (bool) $isNewtab;

        return $link;
    }