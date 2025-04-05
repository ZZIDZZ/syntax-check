protected static function fill(Person $person, array $attrs)
    {
        $attrs = array_merge(
            $attrs,
            $attrs["PersonAffiliations"]["AlumPersonAffiliation"]
        );

        return parent::fill($person, $attrs);
    }