public function registerClientScript()
    {
        $js = [];
        $view = $this->getView();

        DatePickerAsset::register($view);

        $id = $this->options['id'];
        $selector = ";jQuery('#$id')";

        if ($this->addon) {
            $selector .= ".parent()";
        }

        $this->hashPluginOptions($view);

        $js[] = "$selector." . self::PLUGIN_NAME . "({$this->_hashVar});";

        if (!empty($this->dropdownItems)) {
            $js[] = "$selector.find('.dropdown-menu a').on('click', function (e) { e.preventDefault(); jQuery('#$id').val(jQuery(this).data('value')); });";
        }

        if ($this->showDecades === false) {
            $js[] = "$selector.on('dp.show dp.update', function () { $(this).find('.datepicker-years .picker-switch').removeAttr('title').css('cursor', 'default').css('background', 'inherit').on('click', function (e) { e.stopPropagation(); }); });";
        }

        if (!empty($this->clientEvents)) {
            foreach ($this->clientEvents as $event => $handler) {
                $js[] = "$selector.on('$event', $handler);";
            }
        }

        $view->registerJs(implode("\n", $js) . "\n");
    }