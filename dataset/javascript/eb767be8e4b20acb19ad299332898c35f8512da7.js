function injectTemplate (s, node, offset, id) {
  const t = node.src ? readSrc(id, node.src) : node.content

  // Compile template
  const compiled = compiler.compile(t)
  const renderFuncs = '\nrender: ' + toFunction(compiled.render) + ',' +
    '\nstaticRenderFns: [' + compiled.staticRenderFns.map(toFunction).join(',') + '],'
  s.appendLeft(offset, renderFuncs)
  return renderFuncs
}