private function fetchQuotes(array $symbols)
    {
        $url = 'https://query1.finance.yahoo.com/v7/finance/quote?symbols='.urlencode(implode(',', $symbols));
        $responseBody = (string) $this->client->request('GET', $url)->getBody();

        return $this->resultDecoder->transformQuotes($responseBody);
    }