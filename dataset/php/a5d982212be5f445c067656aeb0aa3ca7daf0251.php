protected function configureForm($form, AbstractOptions $options)
    {
        $size = $options->getCompanyLogoMaxSize();
        $type = $options->getCompanyLogoMimeType();
        
        $form->get($this->fileName)->setViewHelper('formImageUpload')
            ->setMaxSize($size)
            ->setAllowedTypes($type)
            ->setForm($form);

        $form->setIsDescriptionsEnabled(true);
        $form->setDescription(
            /*@translate*/ 'Choose a Logo. This logo will be shown in the job opening and the application form.'
        );

        //$form->setHydrator(new ImageHydrator());
    }