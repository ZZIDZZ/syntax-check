public function checkPredictions()
    {
        $exception = new AggregateException(sprintf("%s:\n", $this->name));

        foreach ($this->prophecies as $prophecy) {
            try {
                $prophecy->checkPrediction();
            } catch (PredictionException $e) {
                $exception->append($e);
            }
        }

        if (count($exception->getExceptions())) {
            throw $exception;
        }
    }