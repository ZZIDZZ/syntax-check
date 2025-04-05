protected function addTheme($basePath, $themeName, $parentNamespace = null, $isContainer = false)
    {
        $themePaths = array();
        $themeNamespace = $themeName;

        /**
         * If parent namespace provided, inherit paths from parent and append parent namespace to the theme namespace.
         */
        if ($parentNamespace) {
            if (!in_array($parentNamespace, $this->fsloader->getNamespaces())) {
                throw new Twig_Error_Loader(sprintf('Parent theme "%s" not registered.', $parentNamespace));
            }

            $themePaths = $this->fsloader->getPaths($parentNamespace);
            $themeNamespace = $parentNamespace.static::NP_DELIMITER.$themeName;
        }

        /**
         * Default directory optional.
         * Default directory should be on same level with the new theme.
         */
        $themeDefaultPath = $basePath.DIRECTORY_SEPARATOR.static::DEFAULT_THEME_NAME;
        $themeDefaultPath .= $this->filesDir ? DIRECTORY_SEPARATOR . $this->filesDir : '';
        if (is_dir($themeDefaultPath)) {

            $themeDefaultNamespace = ($parentNamespace ? $parentNamespace.static::NP_DELIMITER : '');
            $themeDefaultNamespace .= static::DEFAULT_THEME_NAME;

            // Strict base name @[@parent]@base
            $this->fsloader->setPaths($themeDefaultPath, static::NP_PREFIX.$themeDefaultNamespace);

            // Add default to theme paths
            if (!in_array($themeDefaultNamespace, $themePaths)) {
                array_unshift($themePaths, $themeDefaultPath);
            }

            // Regular default name with full parent inheritance [@parent]@base
            $this->fsloader->setPaths($themePaths, $themeDefaultNamespace);

        }

        /**
         * Check if theme path directory exists.
         * In case theme is not leaf it is can be only container and it is can do not have files directory,
         * so only default path will be added to namespace paths.
         */
        $themePath = $basePath.DIRECTORY_SEPARATOR.$themeName;
        if (!is_dir($themePath)) {
            throw new Twig_Error_Loader(
                sprintf('Container directory "%s" for theme "%s" not found.', $themePath, $themeNamespace)
            );
        }

        if (!$isContainer) {

            $themeFilesPath = $this->filesDir ? $themePath.DIRECTORY_SEPARATOR.$this->filesDir : $themePath;
            if (!is_dir($themeFilesPath)) {
                throw new Twig_Error_Loader(
                    sprintf('Files directory "%s" for theme "%s" not found.', $themeFilesPath, $themeNamespace)
                );
            }

            // Add theme path to the top of paths
            if (!in_array($themeFilesPath, $themePaths)) {
                array_unshift($themePaths, $themeFilesPath);
            }

            // Strict theme namespace @[@parent]@theme
            $this->fsloader->setPaths($themeFilesPath, static::NP_PREFIX.$themeNamespace);

        }

        // Regular theme namespace [@parent]@theme
        $this->fsloader->setPaths($themePaths, $themeNamespace);

        return array($themePath, $themeNamespace);
    }