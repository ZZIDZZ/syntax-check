function(options) {
            options = options || {}
            if (
              this.passports
              && this.passports.every(t => t instanceof app.orm['Passport'])
              && options.reload !== true
            ) {
              return Promise.resolve(this)
            }
            else {
              return this.getPassports({transaction: options.transaction || null})
                .then(passports => {
                  passports = passports || []
                  this.passports = passports
                  this.setDataValue('passports', passports)
                  this.set('passports', passports)
                  return this
                })
            }
          }