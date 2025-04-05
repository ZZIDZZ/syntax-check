protected function cleanAttributes(array $input, array $valid): array
    {
        foreach ($input as $key => $value) {
            if (preg_match('/^data-(.+)/', $key) || in_array($key, $valid)) {
                continue;
            }
            unset($input[$key]);
        }
        return $input;
    }