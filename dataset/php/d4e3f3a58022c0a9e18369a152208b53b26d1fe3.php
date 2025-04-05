public function getPageSize(Request $request): int
    {
        $pageSize = $request->get('pageSize', 50);

        if ($pageSize > 5000) {
            return 5000;
        }

        return (int) $pageSize;
    }