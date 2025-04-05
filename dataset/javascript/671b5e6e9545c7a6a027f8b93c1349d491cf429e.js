function defaultString (value, defaultDescription) {
        var string = '[' + __('default:') + ' '
    
        if (value === undefined && !defaultDescription) return null
    
        if (defaultDescription) {
          string += defaultDescription
        } else {
          switch (typeof value) {
            case 'string':
              string += JSON.stringify(value)
              break
            case 'object':
              string += JSON.stringify(value)
              break
            default:
              string += value
          }
        }
    
        return string + ']'
      }