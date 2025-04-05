protected function normalizePrecision($precision)
    {
        $precisionFiltered = filter_var($precision, FILTER_SANITIZE_NUMBER_INT);

        return (int) min(10, max(0, $precisionFiltered));
    }