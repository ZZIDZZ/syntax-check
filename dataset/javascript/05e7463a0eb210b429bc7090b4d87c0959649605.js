function tablature(conf) {
  const {
    keys = [],
    data = [],
    headings = {},
    replacements = {},
    centerValues = [],
    centerHeadings = [],
  } = conf
  const [i] = data
  if (!i) return ''

  const cv = makeBinaryHash(centerValues)
  const hv = makeBinaryHash(centerHeadings)

  const k = Object.keys(i).reduce((acc, key) => {
    const h = headings[key]
    return {
      ...acc,
      [key]: h ? h.length : key.length, // initialise with titles lengths
    }
  }, {})

  const widths = data.reduce((dac, d) => {
    const res = Object.keys(d).reduce((acc, key) => {
      const maxLength = dac[key]
      const val = d[key]
      const r = getReplacement(replacements, key)
      const { length } = r(val)
      return {
        ...acc,
        [key]: Math.max(length, maxLength),
      }
    }, {})
    return res
  }, k)

  const kk = keys.reduce((acc, key) => {
    const h = headings[key]
    return {
      ...acc,
      [key]: h || key,
    }
  }, {})
  const hr = keys.reduce((acc, key) => {
    return {
      ...acc,
      [key]: heading,
    }
  }, {})
  const hl = getLine(keys, kk, widths, hr, hv)
  const rl = data.map((row) => {
    const line = getLine(keys, row, widths, replacements, cv)
    return line
  })
  return [
    hl,
    ...rl,
  ].join('\n')
}