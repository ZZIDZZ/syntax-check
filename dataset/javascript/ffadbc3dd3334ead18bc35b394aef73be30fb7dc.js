function without (toRemove) {
  return function (prev, curr) {
    if (!Array.isArray(prev)) {
      prev = !testValue(prev, toRemove)
        ? [ prev ]
        : []
    }
    if (!testValue(curr, toRemove)) prev.push(curr)
    return prev
  }
}