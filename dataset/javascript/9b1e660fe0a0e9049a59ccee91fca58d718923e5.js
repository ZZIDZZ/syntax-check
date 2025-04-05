function (isRequired) {
      if (isRequired === false) {
        return accessors
      }

      if (typeof container[varName] === 'undefined' && typeof defValue === 'undefined') {
        throw new EnvVarError(`"${varName}" is a required variable, but it was not set`)
      }

      return accessors
    }