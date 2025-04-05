public function getFontCss()
    {
        $sharedAsset = new sharedAsset();
        $scss = "";

        foreach ($this->getFonts() as $safeName => $pathInfo) {
            $fontFile = $pathInfo['path'];
            $font = Font::load($fontFile);
            $font->parse();

            if (!empty($font)) {
                $iconFontName = $safeName;

                if (!empty($iconFontName)) {
                    $scss .= "
@font-face {
    font-family: 'dq-iconpicker-".$iconFontName."';
    src: url('../fonts/".$pathInfo['basename']."');
    font-weight: 100;
    font-style: normal;
}\n\n";

                    $scss .= '
[class*="dq-icon-'.$iconFontName.'"] {
  /* use !important to prevent issues with browser extensions that change fonts */
  font-family: dq-iconpicker-'.$iconFontName.' !important;
  speak: none;
  font-style: normal;
  font-weight: normal;
  font-variant: normal;
  text-transform: none;
  line-height: 1;
  display: inline-block;
  vertical-align: baseline;


  /* Better Font Rendering =========== */
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;

}'."\n\n";
                }
            }
        }

        file_put_contents(Craft::getAlias($sharedAsset->sourcePath . '/css/fonts.css'), $scss);

        // Register the assetbundle that loads the generated css
        Craft::$app->view->registerAssetBundle(sharedAsset::className());
    }