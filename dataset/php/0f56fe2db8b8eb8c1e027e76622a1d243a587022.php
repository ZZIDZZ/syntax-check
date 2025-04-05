protected function createActingAs(array $properties = [], string $userModel = null): Authenticatable
    {
        $userClass = $userModel ?: config('auth.providers.users.model');

        $this->actingAs = factory($userClass)->create($properties);
        $this->actingAs($this->actingAs);
        return $this->actingAs;
    }