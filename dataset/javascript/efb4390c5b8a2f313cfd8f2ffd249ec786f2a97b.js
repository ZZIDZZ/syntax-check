async function make(dir) {
  try {
    await makePromise(mkdir, dir)
  } catch (err) {
    if (err.code == 'ENOENT') {
      const parentDir = dirname(dir)
      await make(parentDir)
      await make(dir)
    } else if (err.code != 'EEXIST') { // created in parallel
      throw err
    }
  }
}