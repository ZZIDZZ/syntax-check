function isInAstralSet(code, set) {
  let pos = 0x10000
  for (let i = 0; i < set.length; i += 2) {
    pos += set[i]
    if (pos > code) return false
    pos += set[i + 1]
    if (pos >= code) return true
  }
}