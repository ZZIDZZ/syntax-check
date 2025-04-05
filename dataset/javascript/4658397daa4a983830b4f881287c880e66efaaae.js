function build() {
  log.info(`Creating an optimized production build...`)
  const compiler = createWebpackCompiler(
    () => {
      log.ok(`The ${chalk.cyan(relativeAppBuildPath)} folder is ready to be deployed.`)
    },
    () => {
      log.err(`Aborting`)
      process.exit(2)
    }
  )

  return new Promise((resolve, reject) => {
    compiler.run((err, stats) => {
      if (err) {
        return reject(err)
      }

      return resolve(stats)
    })
  })
}