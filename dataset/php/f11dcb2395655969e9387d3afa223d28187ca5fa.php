private function loadThemeOptions()
    {
        $file = cleanURI($this->themeDIR . 'app/ThemeOptions.php');
        $file = apply_filters('potter_autoload_themeoptions', $file);

        $class = $this->loadFile($file);

        if (!$class):
            $class = new OptionsEmpty();
            add_action('admin_menu', array($this, 'remove_ot_theme_options_page'), 999);
        endif;

        $this->optionsInstance = $class;
    }