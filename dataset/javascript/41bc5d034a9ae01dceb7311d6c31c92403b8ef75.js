function createInstance() {
      const api = extendApi(noUiSlider.create(htmlElement, options));

      setCreatedWatcher(api);
      setOptionsWatcher(api);

      if (ngModel !== null) {
        bindNgModelControls(api);
      }
    }