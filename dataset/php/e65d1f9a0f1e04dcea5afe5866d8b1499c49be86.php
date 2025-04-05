public function resolveFromInput(InputInterface $input): void
    {
        /** @var string[] $sources */
        $sources = $input->getArgument(Option::SOURCE);
        $this->setSources($sources);
        $this->isFixer = (bool) $input->getOption(Option::FIX);
        $this->shouldClearCache = (bool) $input->getOption(Option::CLEAR_CACHE);
        $this->showProgressBar = $this->canShowProgressBar($input);
        $this->showErrorTable = ! (bool) $input->getOption(Option::NO_ERROR_TABLE);
    }