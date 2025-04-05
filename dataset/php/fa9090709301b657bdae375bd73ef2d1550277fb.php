protected function registerClientScript()
    {
        $js = [];
        $id = $this->options['id'];
        TinyMceAsset::register($this->view);
        $this->clientOptions['selector'] = "#{$id}";

        if (!empty($this->clientOptions['language'])) {
            $language_url = LanguageAsset::register($this->view)->baseUrl . "/{$this->clientOptions['language']}.js";
            $this->clientOptions['language_url'] = $language_url;
        }

        $options = Json::encode($this->clientOptions);
        $js[] = "tinymce.init($options);";
        
        if ($this->triggerSaveOnBeforeValidateForm) {
            $js[] = "$('#{$id}').parents('form').on('beforeValidate', function() { tinymce.triggerSave(); });";
        }
        $this->view->registerJs(implode("\n", $js));
    }