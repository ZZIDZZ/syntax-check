function (value, opts, indentLevel) {
    indentLevel = indentLevel === undefined ? 1 : indentLevel + 1

    switch (Object.prototype.toString.call(value)) {
      case '[object Number]':
        return value
      case '[object Array]':
        // Don't prettify arrays nto not take too much space
        var pretty = false
        var valuesRepresentation = value.map(function (v) {
          // Switch to prettify if the value is a dictionary with multiple keys
          if (Object.prototype.toString.call(v) === '[object Object]') {
            pretty = Object.keys(v).length > 1
          }
          return this.literalRepresentation(v, opts, indentLevel)
        }.bind(this))
        return concatArray(valuesRepresentation, pretty, opts.indent, indentLevel)
      case '[object Object]':
        var keyValuePairs = []
        for (var k in value) {
          keyValuePairs.push(util.format('"%s": %s', k, this.literalRepresentation(value[k], opts, indentLevel)))
        }
        return concatArray(keyValuePairs, opts.pretty && keyValuePairs.length > 1, opts.indent, indentLevel)
      case '[object Boolean]':
        return value.toString()
      default:
        if (value === null || value === undefined) {
          return ''
        }
        return '"' + value.toString().replace(/"/g, '\\"') + '"'
    }
  }