protected function renderInput()
    {
        if ($this->hasModel()) {
            $content = Html::activeCheckboxList(
                $this->model,
                $this->attribute,
                $this->items,
                $this->options
            );
        } else {
            $content = Html::checkboxList(
                $this->name,
                $this->value,
                $this->items,
                $this->options
            );
        }

        return Html::tag(
            'div',
            $content,
            [
                'id' => $this->widgetId.'-checkbox',
                'class' => 'checkbox_button_group'.'_checkbox',
            ]
        );
    }