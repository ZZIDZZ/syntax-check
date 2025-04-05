function () {
    // Save original Error.prepareStackTrace
    const origPrepareStackTrace = Error.prepareStackTrace
    // Override with function that just returns `stack`
    Error.prepareStackTrace = (_, stack) => stack

    // Create a new `Error`, which automatically gets `stack`
    const err = new Error()
    // Evaluate `err.stack`, which calls our new `Error.prepareStackTrace`
    const stack = err.stack
    // Restore original `Error.prepareStackTrace`
    Error.prepareStackTrace = origPrepareStackTrace
    // Remove superfluous function call on stack
    stack.shift() // getStack --> Error
    return stack
  }