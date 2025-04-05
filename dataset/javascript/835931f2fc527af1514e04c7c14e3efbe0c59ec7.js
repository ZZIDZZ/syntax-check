function addWithDependencies (allFiles, newFile, dependencies, currentFiles, cycleCheck) {
  if (cycleCheck.indexOf(newFile) >= 0) {
    throw new Error('Dependency cycle found ' + JSON.stringify(cycleCheck))
  }
  cycleCheck.push(newFile)
  try {
    // Add dependencies first
    if (dependencies[newFile]) {
      dependencies[newFile].forEach(function (dependency) {
        if (allFiles.indexOf(dependency) < 0) {
          throw new Error('Dependency "' + dependency + '" of file "' + newFile + '" is not part of ' + JSON.stringify(allFiles))
        }
        addWithDependencies(allFiles, dependency, dependencies, currentFiles, cycleCheck)
      })
    }
    if (currentFiles.indexOf(newFile) < 0) {
      currentFiles.push(newFile)
    }
  } finally {
    cycleCheck.pop()
  }
  return currentFiles
}