protected function flushProcessOutput(ProcessWrapper $processWrapper): void
    {
        $this->io->output(
            $processWrapper->getProcess()->getIncrementalOutput(),
            $processWrapper->getClassName()
        );
        $this->io->errorOutput(
            $processWrapper->getProcess()->getIncrementalErrorOutput(),
            $processWrapper->getClassName()
        );
    }