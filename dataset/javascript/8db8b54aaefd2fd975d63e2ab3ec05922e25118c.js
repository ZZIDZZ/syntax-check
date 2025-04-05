function sortKeyToWhereCondition(keyObj, descending, sortTable, dialect) {
  const { name, quote: q } = dialect
  const sortColumns = []
  const sortValues = []
  for (let key in keyObj) {
    sortColumns.push(`${q(sortTable)}.${q(key)}`)
    sortValues.push(maybeQuote(keyObj[key], name))
  }
  const operator = descending ? '<' : '>'
  return name === 'oracle'
    ? recursiveWhereJoin(sortColumns, sortValues, operator)
    : `(${sortColumns.join(', ')}) ${operator} (${sortValues.join(', ')})`
}