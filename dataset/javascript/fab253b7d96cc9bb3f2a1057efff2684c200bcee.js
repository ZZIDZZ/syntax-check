function rebase(root, src, dest) {
  let relp = rel(root, src)
  return relp ? path.join(dest, relp) : ''
}