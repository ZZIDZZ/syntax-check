protected function getTemplate($template, $replacements = array())
    {

        $path = realpath(__DIR__ . '/../templates/' . $template . '.txt');

        $content = $this->files->get($path);

        if (!empty($replacements)) {
            $content = str_replace(array_keys($replacements), array_values($replacements), $content);
        }

        return $content;
    }