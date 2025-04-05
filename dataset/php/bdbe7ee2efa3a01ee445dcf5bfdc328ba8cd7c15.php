public function editUser(UserModel $model, array $post)
    {
        if (!$model instanceof UserModel) {
            throw new UthandoUserException('$model must be an instance of UthandoUser\Model\User, ' . get_class($model) . ' given.');
        }

        $model->setDateModified();

        /* @var $form UserEditForm */
        $form = $this->getForm(UserEditForm::class);

        $form->setHydrator($this->getHydrator());
        $form->bind($model);

        /* @var $inputFilter \UthandoUser\InputFilter\UserInputFilter */
        $inputFilter = $this->getInputFilter();

        // we need to find if this email has changed,
        // if not then exclude it from validation,
        // if changed then reevaluate it.
        $email = ($model->getEmail() === $post['email']) ? $model->getEmail() : null;

        $inputFilter->addEmailNoRecordExists($email);

        $form->setInputFilter($inputFilter);

        $form->setData($post);
        $form->setValidationGroup([
            'firstname', 'lastname', 'email', 'userId', 'security'
        ]);

        if (!$form->isValid()) {
            return $form;
        }

        $saved = $this->save($form->getData());

        $this->updateSession($saved, $model);

        return $saved;

    }