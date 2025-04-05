protected function isNoneHtmlResponse(IlluminateResponse $content)
    {
        $contentType = $content->headers->get('Content-Type');
        $isHtml      = Str::startsWith($contentType, 'text/html');

        return ! is_null($content) && ! $isHtml;
    }