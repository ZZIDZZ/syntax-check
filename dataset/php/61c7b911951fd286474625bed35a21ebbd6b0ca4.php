public function sectionForm(
        string $forHandle,
        array $sectionFormOptions = []
    ): FormView {

        $sectionFormOptions = SectionFormOptions::fromArray($sectionFormOptions);

        $form = $this->form->buildFormForSection(
            $forHandle,
            $this->requestStack,
            $sectionFormOptions
        );
        $form->handleRequest();

        if ($form->isSubmitted() &&
            $form->isValid()
        ) {
            $data = $form->getData();
            $this->createSection->save($data);

            try {
                $redirect = $sectionFormOptions->getRedirect();
            } catch (\Exception $exception) {
                $redirect = '/';
            }
            header('Location: ' . $redirect);
            exit;
        }

        return $form->createView();
    }