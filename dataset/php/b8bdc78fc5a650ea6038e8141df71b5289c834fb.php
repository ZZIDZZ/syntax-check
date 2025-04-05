public function currentTitle(): array
    {
        if (!$this->currentItem) {
            return [];
        }

        $title = [$this->currentItem->title()];

        if ($this->currentItem instanceof Dropdown && $this->currentDropdownItem) {
            $title[] = $this->currentDropdownItem->title();
        }

        return $title;
    }