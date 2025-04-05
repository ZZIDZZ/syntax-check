function whenRead (args) {
    let value = getValue(args)
    if (value && typeof value.then === 'function') {
      value.then((val) => whenTest(args, val)).catch((error) => {
        console.error(`${action.displayName} caught an error whilst getting a value to test`, error)
      })
    } else {
      whenTest(args, value)
    }
  }