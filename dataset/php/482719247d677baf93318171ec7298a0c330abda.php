public static function InitWith($value) {
        $instance = new Str();
        $instance->value = $value;
        $instance->IsValid();
        return $instance;
    }