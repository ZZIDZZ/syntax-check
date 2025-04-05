function getDependencyURL ({ repositoryURL, dependency }) {
  // githubURL is an object!
  const githubURL = url.parse(
    githubFromGit(repositoryURL) || ''
  )
  if (dependency && !githubURL.href) {
    return `https://www.npmjs.com/package/${dependency}`
  }
  return githubURL
}