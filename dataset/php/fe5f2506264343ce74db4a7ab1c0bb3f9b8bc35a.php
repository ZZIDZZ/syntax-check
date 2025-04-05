public function message() {
    $error = "One or more errors were raised in the Javascript code on the page.
            If you don't care about these errors, you can ignore them by
            setting js_errors: false in your Poltergeist configuration (see documentation for details).";
    //TODO: add javascript errors
    $jsErrors = $this->javascriptErrors();
    foreach($jsErrors as $jsError){
      $error = "$error\n$jsError";
    }
    return $error;
  }