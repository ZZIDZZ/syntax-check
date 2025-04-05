public function process()
    {
        // $this->channel evaluates to blank in the following if, so store it as a variable
        $channel = $this->channel;

        $client = new Client($this->webhookURL);
        if (empty($channel)) {
            $client->send($this->message);
        } else {
            #Send to designated channel
            $client->to($this->channel)->send($this->message);
        }

        // required to terminate the job
        $this->isComplete = true;
        $this->currentStep = 1;
    }