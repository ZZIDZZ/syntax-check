function serializeVerbatim (obj) {
  let i = 0
  const fns = []
  let res = JSON.stringify(obj, (k, v) => {
    if (typeof v === 'function') {
      fns.push(v.toString())
      return `__REPLACE${i++}`
    } else {
      return v
    }
  })
  res = res.replace(/"__REPLACE(\d{1})"/g, (m, v) => {
    return fns[v]
  })
  return res
}