public function updateUser(UserInterface $user, $andFlush = true)
    {
        /** @var EntityManager $em */
        $em = $this->objectManager;
        $meta = $em->getClassMetadata(get_class($user));
        $roleClass = $meta->getAssociationTargetClass('roles');
        $roles = array();
        foreach ($user->getRoles() as $role) {
            if ($roleClass !== get_class($role)) {
                /** Try to get Role */
                if ($em->find($roleClass, $role->getRole())) {
                    try {
                        $_ref = $em->getReference($roleClass, $role->getRole());
                        $roles[] = $_ref;
                    } catch (ORMException $e) {
                        var_dump($e);
                    }
                }else{
                    $_ref = new $roleClass($role->getRole());
                    $em->persist($_ref);
                    $roles[] = $_ref;
                }
            }else{
                $roles[] = $role;
            }
        }
        $user->setRoles($roles);
        parent::updateUser($user, $andFlush);
    }