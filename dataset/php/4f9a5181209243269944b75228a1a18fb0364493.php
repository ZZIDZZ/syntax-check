protected function hasRole($role)
    {
        return $this->getRoles()->contains(function ($key, $value) use ($role) {
            return $role == $value->id || Str::is($role, $value->slug);
        });
    }