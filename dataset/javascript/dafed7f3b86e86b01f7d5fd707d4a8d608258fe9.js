function scopeUrl(options, inst) {
    options = _.extend(options || {}, inst)

    if (!options.url && !options.user_id && !options.group_id && !(options.query || options.query.owner_type && options.query.owner_id)) {
      return callback(new Error('user_id or group_id or (owner_type and owner_id) are required'))
    }

    if (options.user_id) {
      return ngin.User.urlRoot() + '/' + options.user_id + '/personas'
    }

    if (options.group_id) {
      return ngin.Group.urlRoot() + '/' + options.group_id + '/personas'
    }

    if (options.url || options.query.owner_type && options.query.owner_id) {
      return Persona.urlRoot()
    }

  }