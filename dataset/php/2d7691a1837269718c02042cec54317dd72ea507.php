protected function searchPsrMaps()
    {
        $prefixes = array_merge
        (
            $this->composer->getPrefixes(),
            $this->composer->getPrefixesPsr4()
        );

        $trimmedNs = Str::s($this->namespace)->trimRight('\\');

        $nsSegments = $trimmedNs->split('\\');

        foreach ($prefixes as $ns => $dirs)
        {
            $foundSegments = Str::s($ns)->trimRight('\\')
            ->longestCommonPrefix($trimmedNs)->split('\\');

            foreach ($foundSegments as $key => $segment)
            {
                if ((string) $nsSegments[$key] !== (string) $segment)
                {
                    continue 2;
                }
            }

            foreach ($dirs as $dir)
            {
                foreach ((new Finder)->in($dir)->files()->name('*.php') as $file)
                {
                    if ($file instanceof SplFileInfo)
                    {
                        $fqcn = (string)Str::s($file->getRelativePathname())
                        ->trimRight('.php')
                        ->replace('/', '\\')
                        ->ensureLeft($ns);

                        if (Str::s($fqcn)->is($this->namespace.'*'))
                        {
                            $this->foundClasses[$file->getRealPath()] = $fqcn;
                        }
                    }
                }
            }
        }
    }