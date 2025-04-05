public function mix(HSL $color)
    {
        return new self(...mixHSL(
            $this->hue(),
            $this->saturation(),
            $this->lightness(),
            $color->hue(),
            $color->saturation(),
            $color->lightness()
        ));
    }