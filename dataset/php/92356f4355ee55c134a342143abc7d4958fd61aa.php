public function describe(Subject $subject): DescriptionInterface
    {
        $description = $this->createDescription();

        foreach ($this->resolvers as $resolver) {
            $subject = $resolver->resolve($subject);
        }

        foreach ($this->enhancers as $enhancer) {
            if (false === $enhancer->supports($subject)) {
                continue;
            }

            $enhancer->enhanceFromClass($description, $subject->getClass());

            if ($subject->hasObject()) {
                $enhancer->enhanceFromObject($description, $subject);
            }
        }

        return $description;
    }