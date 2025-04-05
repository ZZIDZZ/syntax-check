function (_path) {
  if (/^((pre|post)?loader)s?/ig.test(_path)) {
    return _path.replace(/^((pre|post)?loader)s?/ig, 'module.$1s')
  }

  if (/^(plugin)s?/g.test(_path)) {
    return _path.replace(/^(plugin)s?/g, '$1s')
  }

  return _path
}