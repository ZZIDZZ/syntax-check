function configDeclarationToYargs (yargs, configDeclaration) {
  _.forOwn(configDeclaration, (parameter, parameterName) => {
    parameterDeclarationToYargs(yargs, parameterName, parameter)
  })
  return yargs
}