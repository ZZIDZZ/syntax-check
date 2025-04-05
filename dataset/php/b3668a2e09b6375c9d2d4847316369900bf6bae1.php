protected function buildCaptchaHtml(array $captchaAttribute)
    {
        $options = array_merge(
            ['sitekey' => $this->config->get('captcha.sitekey')],
            $this->config->get('captcha.attributes', [])
        );
        foreach ($captchaAttribute as $key => $value) {
            $options[str_replace('data-', '', $key)] = $value;
        }
        $options = json_encode($options);
        return "grecaptcha.render('{$captchaAttribute['id']}',{$options});";
    }