function() {
    if (this._initialized && !this._isPaused) {
      return false;
    }

    var pauseDuration;

    this._isPaused = false;
    this._prevTime = now();

    pauseDuration = this._prevTime - this._pauseTime;
    this._onResume(pauseDuration);

    this._requestID = raf.request(this._tick);

    return true;
  }