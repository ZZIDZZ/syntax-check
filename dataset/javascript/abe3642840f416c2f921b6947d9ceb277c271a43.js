function factory(list) {
  var expressions = []
  var sensitive = []
  var insensitive = []

  construct()

  return test

  function construct() {
    var length = list.length
    var index = -1
    var value
    var normal

    while (++index < length) {
      value = list[index]
      normal = value === lower(value)

      if (value.charAt(value.length - 1) === '*') {
        // Regexes are insensitive now, once we need them this should check for
        // `normal` as well.
        expressions.push(new RegExp('^' + value.slice(0, -1), 'i'))
      } else if (normal) {
        insensitive.push(value)
      } else {
        sensitive.push(value)
      }
    }
  }

  function test(value) {
    var normal = lower(value)
    var length
    var index

    if (sensitive.indexOf(value) !== -1 || insensitive.indexOf(normal) !== -1) {
      return true
    }

    length = expressions.length
    index = -1

    while (++index < length) {
      if (expressions[index].test(value)) {
        return true
      }
    }

    return false
  }
}