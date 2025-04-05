public function resolve($name, Renderer $renderer = null)
    {
        if ($this->serviceManager->has('ViewTemplatePathStack')) {
            // get all the Pases made up for the zend-provided resolver
            // we won't get any closer to ALL than that
            $viewTemplatePathStack = $this->serviceManager->get('ViewTemplatePathStack');
            $paths = $viewTemplatePathStack->getPaths();
            $defaultSuffix = $viewTemplatePathStack->getDefaultSuffix();
            if (pathinfo($name, PATHINFO_EXTENSION) != $defaultSuffix) {
                ;
                $name .= '.pdf.' . $defaultSuffix;
            } else {
                // TODO: replace Filename by Filename for PDF
            }

            foreach ($paths as $path) {
                $file = new SplFileInfo($path . $name);
                if ($file->isReadable()) {
                    // Found! Return it.
                    if (($filePath = $file->getRealPath()) === false && substr($path, 0, 7) === 'phar://') {
                        // Do not try to expand phar paths (realpath + phars == fail)
                        $filePath = $path . $name;
                        if (!file_exists($filePath)) {
                            break;
                        }
                    }
                    //if ($this->useStreamWrapper()) {
                    //    // If using a stream wrapper, prepend the spec to the path
                    //    $filePath = 'zend.view://' . $filePath;
                    //}
                    return $filePath;
                }
            }
        }
        // TODO: Resolving to an PDF has failed, this could have implications for the transformer
        return false;
    }