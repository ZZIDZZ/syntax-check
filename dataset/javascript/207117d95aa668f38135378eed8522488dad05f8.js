async function processMessengerBody (body, context) {
    const allMessages = getAllMessages(body)
    if (!allMessages || !allMessages.length) return false

    context = context || {}

    for (let message of allMessages) {
      message = _.cloneDeep(message)
      const messageContext = Object.assign({}, context)
      try {
        for (let plugin of middleware) {
          await plugin(message, messageContext)
        }
      } catch (error) {
        const logError = (messageContext.log && messageContext.log.error instanceof Function)
          ? messageContext.log.error
          : console.error
        logError('Error running middleware', error)
      }
    }
    return true
  }