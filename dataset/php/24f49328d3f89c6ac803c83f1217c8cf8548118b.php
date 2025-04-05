public function filter(\Org\Heigl\Hyphenator\Tokenizer\TokenRegistry $tokens)
    {
        foreach ($this as $filter) {
            $tokens = $filter->run($tokens);
        }

        return $tokens;
    }