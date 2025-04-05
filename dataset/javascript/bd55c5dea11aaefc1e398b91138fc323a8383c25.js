function mark(type, attrs) {
  return function(...args) {
    let mark = type.create(takeAttrs(attrs, args))
    let {nodes, tag} = flatten(type.schema, args, n => mark.type.isInSet(n.marks) ? n : n.mark(mark.addToSet(n.marks)))
    return {flat: nodes, tag}
  }
}