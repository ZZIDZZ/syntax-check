public function listNodeCompiler(array &$theme): void
    {
        $this->checkNode($theme);
        $attr = $this->getNodeAttribute($theme);

        foreach ([
            'key',
            'value',
            'index',
        ] as $key) {
            null === $attr[$key] && $attr[$key] = '$'.$key;
        }

        foreach ([
            'for',
            'key',
            'value',
            'index',
        ] as $key) {
            if ('$'.$key === $attr[$key]) {
                continue;
            }

            $attr[$key] = $this->parseContent($attr[$key]);
        }

        // 编译
        $theme['content'] = $this->withPhpTag($attr['index'].' = 1;').PHP_EOL.
            $this->withPhpTag(
                'if (is_array('.$attr['for'].')): foreach ('.$attr['for'].
                ' as '.$attr['key'].' => '.
                $attr['value'].'):'
            ).
            $this->getNodeBody($theme).
            $this->withPhpTag($attr['index'].'++;').PHP_EOL.
            $this->withPhpTag('endforeach; endif;');
    }