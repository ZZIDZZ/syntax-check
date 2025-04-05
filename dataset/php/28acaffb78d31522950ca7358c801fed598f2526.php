public function __async_clearHtml()
    {
        // Tags that do not change
        $allowed_tags = '<b><i><sup><sub><em><strong><u><br><p><table><tr><td><tbody><thead><h1><h2><h3><h4><img><a>';
        // Getting html value
        $html = json_decode(file_get_contents('php://input'), true);
        // Replace tags class
        $html = strip_tags($html['html'], $allowed_tags);
        // Replace tags class
        $html = preg_replace("/<([^>]*)(class)=(\"[^\"]*\"|'[^']*'|[^>]+)([^>]*)>/","<\$1>", $html);
        // Replace tags lang
        $html = preg_replace("/<([^>]*)(lang)=(\"[^\"]*\"|'[^']*'|[^>]+)([^>]*)>/","<\$1>", $html);
        // Replace tags style
        $html = preg_replace("/<([^>]*)(style)=(\"[^\"]*\"|'[^']*'|[^>]+)([^>]*)>/","<\$1>", $html);
        // Replace tags size
        $html = preg_replace("/<([^>]*)(size)=(\"[^\"]*\"|'[^']*'|[^>]+)([^>]*)>/","<\$1>", $html);
        // Replace all transfers and &nbsp;
        $html = str_replace(array("\r\n", "\r", "\n", '&nbsp;'), ' ', $html);
        // Replace empty tags p and b
        $html = str_replace(array("<p> </p>", "<p></p>", "<b> </b>", "<b></b>"), '', $html);
        // Added border to table
        $html = str_replace(array("<table"), '<table border="1"', $html);

        return array('status' => 1, 'data' => $html);
    }