function findAllDependencies(file, knownDependencies, sourceDirectories, knownFiles) {
  if (!knownDependencies) {
    knownDependencies = [];
  }

  if (typeof knownFiles === "undefined"){
    knownFiles = [];
  } else if (knownFiles.indexOf(file) > -1){
    return knownDependencies;
  }

  if (sourceDirectories) {
    return findAllDependenciesHelp(file, knownDependencies, sourceDirectories, knownFiles).then(function(thing){
      return thing.knownDependencies;
    });
  } else {
    return getBaseDir(file)
      .then(getElmPackageSourceDirectories)
      .then(function(newSourceDirs) {
        return findAllDependenciesHelp(file, knownDependencies, newSourceDirs, knownFiles).then(function(thing){
          return thing.knownDependencies;
        });
      });
  }
}