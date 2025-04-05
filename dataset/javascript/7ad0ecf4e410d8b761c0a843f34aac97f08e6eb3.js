function (ev) {
    var nextPointers

    if (!ev.defaultPrevented) {
      if (_preventDefault) {
        ev.preventDefault()
      }

      if (!_mouseDown) {
        _mouseDown = true

        nextPointers = utils.clone(_currPointers) // See [2]
        nextPointers['mouse'] = [ev.pageX, ev.pageY]

        if (!_started) {
          _started = true
          _handlers.start(nextPointers)
        }

        _currPointers = nextPointers
      }
    }
  }