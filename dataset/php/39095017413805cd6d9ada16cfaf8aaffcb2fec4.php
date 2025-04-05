protected function hasAnsi()
    {
        if (DIRECTORY_SEPARATOR === '\\') {
            return
                0 >= version_compare('10.0.10586',
                    PHP_WINDOWS_VERSION_MAJOR . '.' . PHP_WINDOWS_VERSION_MINOR . '.' . PHP_WINDOWS_VERSION_BUILD)
                || false !== getenv('ANSICON')
                || 'ON' === getenv('ConEmuANSI')
                || 'xterm' === getenv('TERM');
        }

        return function_exists('posix_isatty') && @posix_isatty($this->stream);
    }