protected function _build($tokens, $space) {
        $output = '';
        $lastToken = false;
        $level = 0;

        foreach ($tokens as $token) {
            switch ($token['token']) {
                case 'code':
                    $output .= $space . $token['code'] . $this->newline;
                    break;

                case '}':
                    $level --;
                    $space = substr($space, strlen($this->tab));
                    $output .= $space . '}' . $this->newline;
                    break;

                case '{':
                    if ($lastToken === '}') {
                        // Double new line between 2 items in same scope
                        $output .= $this->newline;
                    }
                    if (isset($token['selectors'])) {
                        $output .= $space . implode($this->selectorsSeparator, $token['selectors']);
                    } elseif (isset($token['atRule'])) {
                        $output .= $space . '@' . $token['atRule'];
                        if (!empty($token['atValues'])) {
                            $values = implode($this->selectorsSeparator, $token['atValues']);
                            $output .= $values === '' ? '' : ' ' . $values;
                        }
                    } else {
                        // Error - use code as backup
                        $output .= $space . $token['code'];
                    }
                    $output .= ($this->newLineAfterSelector ?
                            $this->newline . $space :
                            ($this->minify ? '' : ' ')
                        ) . '{' . $this->newline;
                    if (isset($token['children'])) {
                        $output .= $this->_build($token['children'], $space . $this->tab);
                        $output .= $space . '}' . $this->newline;
                    } else {
                        $level ++;
                        $space .= $this->tab;
                    }
                    break;

                case 'rule':
                    $output .= $space . $token['key'] . $this->ruleSeparator . $token['value'];
                    foreach ($this->ruleModifiers as $mod) {
                        if (!empty($token[$mod])) {
                            $output .= ' !' . $mod;
                        }
                    }
                    $output .= ';' . $this->newline;
                    break;
            }
            $lastToken = $token['token'];
        }

        return $output;
    }