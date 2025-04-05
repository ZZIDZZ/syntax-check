protected function hasSubMenu($menu_item_id)
    {
        // Submenu always available with a path > 1
        if (count($this->meta['path']) > 1)
            return true;

        // Decide if the first level menu has any visible submenu items
        foreach ($this->menu as $item) {
            // Find the desired menu item in the first level
            if ($item['menu_item_id'] == $menu_item_id) {
                // Loop through each submenu item
                foreach ($item['submenu'] as $sub_item) {
                    // If there is at least one active item
                    if ($sub_item['is_active'] == true) {
                        // There is a submenu to display
                        return true;
                    }
                }
            }
        }

        return false;
    }