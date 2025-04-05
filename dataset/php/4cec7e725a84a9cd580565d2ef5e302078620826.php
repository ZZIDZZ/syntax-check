private static function asHtmlBlock(\stdClass $block, $linkResolver = null, $htmlSerializer = null)
    {
        $content = '';
        if ($block->type === 'heading1' ||
            $block->type === 'heading2' ||
            $block->type === 'heading3' ||
            $block->type === 'heading4' ||
            $block->type === 'heading5' ||
            $block->type === 'heading6' ||
            $block->type === 'paragraph' ||
            $block->type === 'list-item' ||
            $block->type === 'o-list-item' ||
            $block->type === 'preformatted'
        ) {
            $content = RichText::insertSpans($block->text, $block->spans, $linkResolver, $htmlSerializer);
        }
        return RichText::serialize((object)$block, $content, $linkResolver, $htmlSerializer);
    }