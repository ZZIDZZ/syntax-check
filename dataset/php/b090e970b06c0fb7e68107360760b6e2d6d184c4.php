public static function get_order_link($orderID, $urlSegment = false)
    {
        $page = self::get_if_account_page_exists();
        return ($urlSegment ? $page->URLSegment . '/' : $page->Link()) . 'order/' . $orderID;
    }