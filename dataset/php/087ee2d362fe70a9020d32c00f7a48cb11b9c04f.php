public function addTransformers(array $dataTransformers)
    {
        foreach ($dataTransformers as $type => $dataTransformer) {

            if ( ! $dataTransformer instanceof DataTransformerInterface) {
                throw new InvalidDataTransformerException();
            }

            $this->addTransformer($type, $dataTransformer);
        }

        return $this;
    }