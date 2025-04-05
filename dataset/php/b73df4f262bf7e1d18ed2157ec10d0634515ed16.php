public function submitTransaction(TransactionBuilder $transactionBuilder, $signingAccountSeedString)
    {
        $transactionEnvelope = $transactionBuilder->sign($signingAccountSeedString);

        return $this->submitB64Transaction(base64_encode($transactionEnvelope->toXdr()));
    }