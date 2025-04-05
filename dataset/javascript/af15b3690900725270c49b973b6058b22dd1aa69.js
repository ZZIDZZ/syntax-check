function addProps(props, options) {
  if (!props) return '## No props'
  const keys = Object.keys(props).filter(key =>
    filterProps(key, props[key], options),
  )
  const filteredProps = keys.reduce(
    (last, key) => ({ ...last, [key]: props[key] }),
    {},
  )

  let output = '\n## Props\n'
  let isFlow = false
  const items = [
    TABLE_HEADERS,
    ...keys.map(key => {
      const prop = filteredProps[key]
      if (isFlowType(prop)) isFlow = true

      const row = [
        isFlowType(prop) ? key : getKey(key, getType(prop)),
        getTypeName(getType(prop)),
        getDefaultValue(prop),
        prop.required,
        prop.description,
      ]
      return row.map(rowValue => {
        if (typeof rowValue === 'string') {
          return rowValue.split('\n').join('<br>')
        }
        return rowValue
      })
    }),
  ]

  output += `${table(items)}\n`

  // Add subtypes
  if (!isFlow) {
    const subTypes = describeSubTypes(filteredProps)
    if (subTypes.length) {
      output += '\n## Complex Props\n'
      output += subTypes
    }
  }

  return output
}