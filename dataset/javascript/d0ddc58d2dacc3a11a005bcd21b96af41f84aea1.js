function outHandler (options, next) {
          options.params = options.params || {}

          if (params.datacenter) {
            options.params.dc = params.datacenter
          }

          if (params.onlyHealthy) {
            options.params.passing = true
          }

          if (params.tag) {
            options.params.tag = params.tag
          }

          next()
        }