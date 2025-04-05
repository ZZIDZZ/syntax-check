public function truncate($long_text, $length, $options = [])
    {
        $short_text = mb_substr($long_text, 0, $length);

        if ($short_text === $long_text) {
            return $long_text;
        }

        $short_text .= '...';

        if (array_get($options, 'html', false)) {
            $short_text .= ' <span class="f-10 f-w-100">(truncated)</span>';
        }

        if (array_get($options, 'html', false)) {
            $short_text = sprintf('<span title="%s">%s</span>', htmlspecialchars($long_text), $short_text);
        }

        return $short_text;
    }