function _0to1(props, propName, componentName) {
  if (isEmpty(props[propName])) {
    return null
  }
  if (
    typeof props[propName] === 'number' &&
    props[propName] >= 0 &&
    props[propName] <= 1
  ) {
    return null
  }
  return new Error(
    `Invalid prop \`${propName}\` supplied to \`${componentName}\`. Please provide a number in the 0-1 range.`
  )
}