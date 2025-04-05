async function readDirStructure(dirPath) {
  if (!dirPath) {
    throw new Error('Please specify a path to the directory')
  }
  const ls = await makePromise(lstat, dirPath)
  if (!ls.isDirectory()) {
    const err = new Error('Path is not a directory')
    err.code = 'ENOTDIR'
    throw err
  }
  const dir = /** @type {!Array<string>} */ (await makePromise(readdir, dirPath))
  const lsr = await lstatFiles(dirPath, dir)

  const directories = lsr.filter(isDirectory) // reduce at once
  const notDirectories = lsr.filter(isNotDirectory)

  const files = notDirectories.reduce((acc, current) => {
    const type = getType(current)
    return {
      ...acc,
      [current.relativePath]: {
        type,
      },
    }
  }, {})

  const dirs = await directories.reduce(async (acc, { path, relativePath }) => {
    const res = await acc
    const structure = await readDirStructure(path)
    return {
      ...res,
      [relativePath]: structure,
    }
  }, {})

  const content = {
    ...files,
    ...dirs,
  }
  return {
    content,
    type: 'Directory',
  }
}