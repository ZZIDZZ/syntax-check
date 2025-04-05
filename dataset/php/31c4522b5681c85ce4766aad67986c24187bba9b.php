public function convertString($content, $oldFormat, $newFormat)
    {
        $tempFile = $this->tempFileFactory->createFile($content, $oldFormat);

        try {
            $output = $this->convertFile($tempFile, $newFormat);
        } catch (\Exception $e) {
            // Cleanup the temp file, even with a failure
            unlink($tempFile->getRealPath());
            throw $e;
        }
        unlink($tempFile->getRealPath());

        return $output;
    }