private static function copyFile($sourcePathOfFile, $destinationPath, $globExpressionList)
    {
        $filesystem = new Filesystem();

        $relativeSourcePath = self::getRelativePathForSingleFile($sourcePathOfFile);

        if (!GlobMatcher::matchAny($relativeSourcePath, $globExpressionList)) {
            $filesystem->copy($sourcePathOfFile, $destinationPath, ["override" => true]);
        }
    }