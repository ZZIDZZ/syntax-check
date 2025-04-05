public function toArray()
    {
        return array(
            'rawDiff' => $this->rawDiff,
            'files' => array_map(
                function (File $file) {
                    return $file->toArray();
                },
                $this->files
            ),
        );
    }