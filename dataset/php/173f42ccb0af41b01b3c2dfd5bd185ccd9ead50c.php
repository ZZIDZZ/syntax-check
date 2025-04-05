public function getModifiers() : int
    {
        $val  = 0;
        $val += $this->isPublic() ? ReflectionProperty::IS_PUBLIC : 0;
        $val += $this->isProtected() ? ReflectionProperty::IS_PROTECTED : 0;
        $val += $this->isPrivate() ? ReflectionProperty::IS_PRIVATE : 0;

        return $val;
    }