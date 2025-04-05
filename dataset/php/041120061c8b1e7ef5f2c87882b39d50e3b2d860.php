public function loadFile($file_name, $extension, $full_path = '')
    {
        if (array_has(config('rev-manifest', []), $file_name) || (!empty($full_path) && file_exists($full_path))) {
            if (env('APP_ASSET_INLINE', false)) {
                if (!isset($this->loaded_inline[$full_path])) {
                    $contents = file_get_contents($full_path);
                    $contents = '/* '.$file_name." */ \n\n".$contents;
                    if ($extension == 'js') {
                        $this->addScript($contents, 'inline');
                    } else {
                        $this->addStyle($contents);
                    }
                    $this->loaded_inline[$full_path] = true;
                }
            } else {
                $this->add($file_name, 'ready');
            }
        }
    }