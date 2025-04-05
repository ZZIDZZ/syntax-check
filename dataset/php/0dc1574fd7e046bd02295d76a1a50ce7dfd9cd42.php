public function edit(Roles $role)
    {
        $this->authorize('edit_role');

        $valueList = $role->permissions()->get()->pluck('id')->toArray();
        return view(
            'RoleManager::role.edit',
            ['role' => $role, 'permissions' => Permissions::all(),
                'valueList' => $valueList]
        );
    }