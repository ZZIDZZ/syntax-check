private function registerSettings(SectionInterface $section)
    {
        array_map(
            function (FieldInterface $field) {
                register_setting(
                    $this->pageSlug,
                    $field->getId(),
                    $field->getAdditionalArguments()
                );
            },
            $section->getFields()
        );
    }