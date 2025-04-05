function(fn) {
    var pending
    var hasNext

    function next() {
      setTimeout(function() {
        if (pending === false) return
        pending = false

        if (hasNext) {
          hasNext = false
          fn(next)
        }
      }, 50) // call after gulp ending handler done
    }
    return function() {
      if (pending) return (hasNext = true)

      pending = true
      fn(next)
    }
  }